
(() => {
    'use strict';

    const root = document.getElementById('staynestChat');
    if (!root) return;

    const base = root.dataset.apiBase;

    const list = document.getElementById('chatListItems');
    const body = document.getElementById('chatMessages');
    const header = document.getElementById('activeChatHeader');
    const form = document.getElementById('chatSendForm');
    const input = document.getElementById('chatMessageInput');
    const send = form?.querySelector('button[type="submit"]');
    const active = document.getElementById('activeConversationId');
    const feedback = document.getElementById('chatFeedback');
    const search = document.getElementById('chatSearch');
    const refresh = document.getElementById('refreshChats');

    const currentUserId = Number(window.CURRENT_USER_ID || 0);

    const requestedId = Number(
        new URLSearchParams(window.location.search)
            .get('conversation_id') || 0
    );

    if (!base || !list || !body || !header ||
        !form || !input || !send || !active ||
        !feedback || !search || !refresh) {
        console.error('StayNest Chat: Required elements missing.');
        return;
    }

    let conversations = [];
    let currentId = 0;
    let loadingMessages = false;

    const esc = value => String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;'
    }[char]));

    function showFeedback(message) {
        feedback.textContent = message || '';
    }

    async function api(file, options = {}) {
        const response = await fetch(base + file, {
            credentials: 'same-origin',
            ...options
        });

        const raw = await response.text();

        let result;

        try {
            result = JSON.parse(raw);
        } catch {
            throw new Error(
                `Invalid API response (HTTP ${response.status}).`
            );
        }

        if (!response.ok || !result.success) {
            throw new Error(
                result.message || `Request failed (${response.status})`
            );
        }

        return result.data || {};
    }

    function showPlaceholder(message) {
        currentId = 0;
        active.value = '';
        input.disabled = true;
        send.disabled = true;

        header.innerHTML = `
            <div class="chat-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <h5>Select a conversation</h5>
                <small>Your messages appear here</small>
            </div>
        `;

        body.innerHTML = `
            <div class="chat-placeholder">
                <i class="bi bi-chat-square-text"></i>
                <h5>Your conversations</h5>
                <p>${esc(message)}</p>
            </div>
        `;
    }

    function renderList() {
        const query = search.value.trim().toLowerCase();

        const filtered = conversations.filter(item => {
            const text =
                `${item.other_user_name || ''} ${item.property_title || ''}`;

            return text.toLowerCase().includes(query);
        });

        list.innerHTML = filtered.length
            ? filtered.map(item => `
                <button type="button"
                    class="chat-item ${
                        Number(item.id) === currentId ? 'active' : ''
                    }"
                    data-id="${Number(item.id)}">

                    <span class="chat-avatar">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    <span class="chat-info">
                        <strong>${esc(item.other_user_name || 'StayNest User')}</strong>
                        <small>${esc(item.property_title || 'StayNest Chat')}</small>
                        <span>${esc(item.last_message || 'Start a conversation')}</span>
                    </span>

                    ${
                        Number(item.unread_count) > 0
                            ? `<span class="chat-unread">${Number(item.unread_count)}</span>`
                            : ''
                    }
                </button>
            `).join('')
            : '<div class="chat-empty">No conversations found.</div>';
    }

    async function loadMessages() {
        if (!currentId || loadingMessages) return;

        loadingMessages = true;

        try {
            const data = await api(
                `messages.php?conversation_id=${encodeURIComponent(currentId)}`
            );

            const messages = data.messages || [];

            body.innerHTML = messages.length
                ? messages.map(message => `
                    <article class="message ${
                        Number(message.sender_id) === currentUserId
                            ? 'sent'
                            : 'received'
                    }">
                        <div class="message-text">${esc(message.message)}</div>
                        <time class="message-time">
                            ${esc(message.created_at || '')}
                        </time>
                    </article>
                `).join('')
                : `
                    <div class="chat-placeholder">
                        <i class="bi bi-chat-square-text"></i>
                        <h5>Conversation started!</h5>
                        <p>No messages yet. Send the first message.</p>
                    </div>
                `;

            body.scrollTop = body.scrollHeight;
            showFeedback('');

        } catch (error) {
            showFeedback(error.message);
            console.error('Chat messages error:', error);
        } finally {
            loadingMessages = false;
        }
    }

    async function openChat(id) {
        const conversation = conversations.find(
            item => Number(item.id) === Number(id)
        );

        if (!conversation) {
            showFeedback('Conversation not found in your account.');
            return;
        }

        currentId = Number(id);
        active.value = String(currentId);

        header.innerHTML = `
            <div class="chat-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <h5>${esc(conversation.other_user_name || 'StayNest User')}</h5>
                <small>${esc(conversation.property_title || 'StayNest Chat')}</small>
            </div>
        `;

        input.disabled = false;
        send.disabled = false;

        renderList();
        await loadMessages();
    }

    
    async function loadConversations() {
        list.innerHTML =
            '<div class="chat-empty">Loading conversations...</div>';
    
        try {
            const data = await api('conversations.php');
        
            conversations = data.conversations || [];
        
            renderList();
        
            // Property page se specific conversation open hui ho
            if (requestedId > 0) {
                const requested = conversations.find(
                    item => Number(item.id) === requestedId
                );
            
                if (requested) {
                    await openChat(requested.id);
                } else {
                    showPlaceholder(
                        'This conversation is not available in your account.'
                    );
                }
            
                return;
            }
        
            // Already selected conversation ko refresh par maintain karo
            if (currentId && conversations.some(
                item => Number(item.id) === currentId
            )) {
                await openChat(currentId);
                return;
            }
        
            // Default: koi chat automatically open nahi hogi
            showPlaceholder(
                'Select a conversation from the left to start chatting.'
            );
        
        } catch (error) {
            list.innerHTML =
                `<div class="chat-empty">${esc(error.message)}</div>`;
        
            showPlaceholder(error.message);
            showFeedback(error.message);
        
            console.error('Chat conversation error:', error);
        }
    }


    list.addEventListener('click', event => {
        const button = event.target.closest('[data-id]');

        if (button) {
            openChat(button.dataset.id);
        }
    });

    search.addEventListener('input', renderList);

    refresh.addEventListener('click', loadConversations);

    form.addEventListener('submit', async event => {
        event.preventDefault();

        const message = input.value.trim();

        if (!message || !currentId) return;

        send.disabled = true;

        try {
            const payload = new FormData();

            payload.append('conversation_id', String(currentId));
            payload.append('message', message);

            await api('send.php', {
                method: 'POST',
                body: payload
            });

            input.value = '';

            await loadMessages();
            await loadConversations();

        } catch (error) {
            showFeedback(error.message);
            console.error('Chat send error:', error);
        } finally {
            send.disabled = !currentId;
            input.focus();
        }
    });

    loadConversations();

    const refreshTimer = window.setInterval(async () => {
        await loadConversations();

        if (currentId) {
            await loadMessages();
        }
    }, 7000);

    window.addEventListener('beforeunload', () => {
        window.clearInterval(refreshTimer);
    });

})();
