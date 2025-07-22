<div class="comment-item {{ $comment->parent_id ? 'comment-reply' : 'comment-root' }}" id="comment-{{ $comment->id }}">
    <div class="comment-wrapper">
        <div class="comment-left">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
                alt="Avatar" class="comment-avatar">
            @if ($comment->parent_id)
                <div class="thread-line"></div>
            @endif
        </div>

        <div class="comment-right">
            <div class="comment-header">
                <span class="comment-username">{{ $comment->user->name }}</span>
                <span class="comment-separator">•</span>
                <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                @if ($comment->parent_id && $comment->parent)
                    <span class="comment-separator">•</span>
                    <span class="comment-reply-to">
                        replying to
                        <a href="#comment-{{ $comment->parent->id }}" class="reply-link">
                            {{ $comment->parent->user->name }}
                        </a>
                    </span>
                @endif
            </div>

            {{-- Comment body --}}
            <div class="comment-body">
                {{ $comment->body }}
            </div>

            {{-- Comment actions --}}
            @php
                $userHasLiked = $userLikes->contains($comment->id);
            @endphp

            <div class="comment-actions">
                <form class="like-form" action="{{ route('comments.like', $comment) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="action-btn like-btn {{ $userHasLiked ? 'text-primary' : 'text-muted' }}">
                        <i class="fas fa-thumbs-up"></i>
                        <span class="likes-count">{{ $comment->likes_count }}</span>
                    </button>
                </form>

                <button class="action-btn reply-btn" data-bs-toggle="collapse"
                    href="#comment-form-{{ $comment->id }}">
                    <i class="fas fa-comment"></i> Reply
                </button>
            </div>

            {{-- Reply Form (Initially Hidden) --}}
            <div class="collapse mt-3 reply-form-container" id="comment-form-{{ $comment->id }}">
                <form action="{{ route('comments.store') }}" method="POST" class="reply-form">
                    @csrf
                    <input type="hidden" name="material_id" value="{{ $material->id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="reply-input-container">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=random"
                            alt="Your Avatar" class="reply-avatar">
                        <textarea class="reply-textarea" name="body" rows="3" placeholder="What are your thoughts?"></textarea>
                    </div>
                    <div class="reply-actions">
                        <button type="button" class="btn-cancel" data-bs-toggle="collapse"
                            href="#comment-form-{{ $comment->id }}">Cancel</button>
                        <button type="submit" class="btn-submit">Comment</button>
                    </div>
                </form>
            </div>

            {{-- Show more replies indicator --}}
            @if ($comment->replies->isNotEmpty())
                <div class="replies-container mt-3">
                    {{-- Tombol hanya muncul jika balasan lebih dari 1 --}}
                    @if ($comment->replies->count() > 1)
                        <a class="show-more-replies" data-bs-toggle="collapse" href="#replies-for-{{ $comment->id }}"
                            role="button" aria-expanded="false"
                            data-show-text="+ {{ $comment->replies->count() }} more replies"
                            data-hide-text="Sembunyikan balasan">
                            <i class="fas fa-plus toggle-icon"></i>
                            <span class="toggle-text">{{ $comment->replies->count() }} more replies</span>
                        </a>
                    @endif

                    {{-- Wrapper untuk balasan yang bisa disembunyikan --}}
                    <div class="collapse {{ $comment->replies->count() <= 1 ? 'show' : '' }}"
                        id="replies-for-{{ $comment->id }}">
                        @foreach ($comment->replies as $reply)
                            @include('user.partials.comment', [
                                'comment' => $reply,
                                'material' => $material,
                            ])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
