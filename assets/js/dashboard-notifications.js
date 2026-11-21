(() => {
    'use strict';

    const toggle = document.getElementById('notificationToggle');
    const dropdown = document.getElementById('notificationDropdown');
    const badge = document.getElementById('notificationBadge');
    const items = document.getElementById('notificationItems');
    const markAll = document.getElementById('markAllNotificationsRead');
    if (!toggle || !dropdown || !badge || !items || !markAll) return;

    const apiBase = '../backend/api/notifications/';
    let busy = false;

    const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[char]));

    async function request(file, options = {}) {
        const response = await fetch(apiBase + file, {
            credentials: 'same-origin',
            cache: 'no-store',
            ...options
        });
        const raw = await response.text();
        let result;
        try { result = JSON.parse(raw); }
        catch { throw new Error(`Notification API returned invalid data (HTTP ${response.status}).`); }
        if (!response.ok || !result.success) throw new Error(result.message || `HTTP ${response.status}`);
        return result.data || {};
    }

    function render(data) {
        const count = Number(data.unread_count || 0);
        badge.textContent = count > 99 ? '99+' : String(count);
        badge.hidden = count < 1;

        const notifications = data.notifications || [];
        if (!notifications.length) {
            items.innerHTML = '<div class="notification-empty">You are all caught up. No notifications yet.</div>';
            return;
        }

        items.innerHTML = notifications.map(item => {
            const isMessage = item.notification_type === 'message';
            const target = isMessage && Number(item.reference_id) > 0
                ? `../dashboard/messages.php?conversation_id=${Number(item.reference_id)}`
                : '#';
            return `<a class="notification-item ${Number(item.is_read) ? '' : 'unread'}"
                href="${target}" data-notification-id="${Number(item.id)}"
                data-target="${target}">
                <span class="notification-item-icon"><i class="bi ${isMessage ? 'bi-chat-dots-fill' : 'bi-bell-fill'}"></i></span>
                <span><strong>${escapeHtml(item.title)}</strong>
                <small>${escapeHtml(item.message)}</small>
                <time>${escapeHtml(item.created_at || '')}</time></span>
            </a>`;
        }).join('');
    }

    async function load() {
        if (busy) return;
        busy = true;
        try { render(await request('list.php')); }
        catch (error) { console.error('StayNest notifications:', error); }
        finally { busy = false; }
    }

    toggle.addEventListener('click', () => {
        const opening = dropdown.hidden;
        dropdown.hidden = !opening;
        toggle.setAttribute('aria-expanded', String(opening));
        if (opening) load();
    });

    document.addEventListener('click', event => {
        if (!event.target.closest('.topbar-notification-wrap')) {
            dropdown.hidden = true;
            toggle.setAttribute('aria-expanded', 'false');
        }
    });

    items.addEventListener('click', async event => {
        const link = event.target.closest('[data-notification-id]');
        if (!link) return;
        event.preventDefault();
        const id = Number(link.dataset.notificationId);
        const target = link.dataset.target;
        if (id) {
            const form = new FormData();
            form.append('notification_id', String(id));
            try { await request('read.php', { method: 'POST', body: form }); }
            catch (error) { console.error('Could not mark notification read:', error); }
        }
        if (target && target !== '#') window.location.href = target;
    });

    markAll.addEventListener('click', async () => {
        const form = new FormData();
        try {
            await request('read.php', { method: 'POST', body: form });
            await load();
        } catch (error) { console.error('Could not mark notifications read:', error); }
    });

    load();
    window.setInterval(load, 12000);
})();
