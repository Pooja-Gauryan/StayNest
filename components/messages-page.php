<?php require_once __DIR__ . '/../backend/helpers/session.php'; ?>
<script>
    const CURRENT_USER_ID = <?= (int)($_SESSION["user"]["id"] ?? 0) ?>;
</script>
<section class="messages-page" id="staynestChat" data-api-base="../backend/api/chat/">
    <div class="page-header">
        <div>
            <h2>Messages</h2>
            <p>Chat directly with students and property owners.</p>
        </div>
    </div>
    <div class="messages-container">
        <aside class="chat-list">
            <div class="chat-list-heading">
                <h5>Conversations</h5><button type="button" id="refreshChats" class="chat-refresh" aria-label="Refresh conversations"><i class="bi bi-arrow-clockwise"></i></button>
            </div>
            <div class="chat-search"><i class="bi bi-search"></i><input id="chatSearch" type="search" placeholder="Search chats..."></div>
            <div id="chatListItems" class="chat-list-items">
                <div class="chat-empty">Loading conversations...</div>
            </div>
        </aside>
        <section class="chat-window" aria-label="Chat conversation">
            <header class="chat-header" id="activeChatHeader">
                <div class="chat-avatar"><i class="bi bi-person-fill"></i></div>
                <div>
                    <h5>Select a conversation</h5><small>Your messages appear here</small>
                </div>
            </header>
            <div class="chat-body" id="chatMessages">
                <div class="chat-placeholder"><i class="bi bi-chat-square-text"></i>
                    <h5>Your conversations</h5>
                    <p>Choose a chat on the left to view messages.</p>
                </div>
            </div>
            <form class="chat-footer" id="chatSendForm"><input type="hidden" id="activeConversationId"><input id="chatMessageInput" type="text" maxlength="2000" placeholder="Type a message..." autocomplete="off" disabled><button class="send-btn" type="submit" disabled aria-label="Send message"><i class="bi bi-send-fill"></i></button></form>
            <div class="chat-feedback" id="chatFeedback" role="status" aria-live="polite"></div>
        </section>
    </div>
</section>