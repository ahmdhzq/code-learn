<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CodeLearn')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        /* Reddit-style Comment Styles */
        .comment-item {
            margin-bottom: 0;
            background-color: white;
            border-bottom: 1px solid #f0f0f0;
        }

        .comment-wrapper {
            display: flex;
            padding: 12px 16px;
            position: relative;
        }

        /* Left side - Avatar and thread line */
        .comment-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 12px;
            min-width: 32px;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .thread-line {
            width: 2px;
            background-color: #e9ecef;
            flex-grow: 1;
            margin-top: 8px;
            min-height: 20px;
        }

        /* Right side - Content */
        .comment-right {
            flex: 1;
            min-width: 0;
        }

        /* Comment header */
        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 4px;
            font-size: 12px;
            color: #878a8c;
        }

        .comment-username {
            font-weight: 600;
            color: #1c1c1c;
            font-size: 12px;
        }

        .comment-separator {
            margin: 0 4px;
            color: #878a8c;
        }

        .comment-time {
            color: #878a8c;
        }

        .comment-reply-to {
            color: #878a8c;
        }

        .reply-link {
            color: #0079d3;
            text-decoration: none;
            font-weight: 500;
        }

        .reply-link:hover {
            text-decoration: underline;
            color: #0079d3;
        }

        /* Comment body */
        .comment-body {
            font-size: 14px;
            line-height: 1.4;
            color: #1c1c1c;
            margin-bottom: 8px;
            word-wrap: break-word;
        }

        /* Comment actions */
        .comment-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .action-btn {
            background: none;
            border: none;
            padding: 4px 6px;
            border-radius: 2px;
            font-size: 12px;
            color: #878a8c;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
            transition: background-color 0.1s ease;
        }

        .action-btn:hover {
            background-color: #f8f9fa;
            color: #1c1c1c;
        }

        .action-btn i {
            font-size: 12px;
        }

        .upvote-btn:hover {
            color: #ff4500;
        }

        .downvote-btn:hover {
            color: #7193ff;
        }

        .reply-btn:hover {
            color: #878a8c;
        }

        .vote-count {
            font-weight: 600;
            font-size: 12px;
        }

        /* Reply form styles */
        .reply-form-container {
            margin-top: 8px;
            padding-left: 0;
        }

        .reply-form {
            background-color: #fafafa;
            border: 1px solid #edeff1;
            border-radius: 4px;
            padding: 12px;
        }

        .reply-input-container {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .reply-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .reply-textarea {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
        }

        .reply-textarea:focus {
            outline: none;
            border-color: #0079d3;
            box-shadow: 0 0 0 1px #0079d3;
        }

        .reply-textarea::placeholder {
            color: #878a8c;
        }

        .reply-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-cancel,
        .btn-submit {
            padding: 4px 16px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            border: 1px solid;
            transition: all 0.1s ease;
        }

        .btn-cancel {
            background-color: transparent;
            color: #0079d3;
            border-color: #0079d3;
        }

        .btn-cancel:hover {
            background-color: #0079d3;
            color: white;
        }

        .btn-submit {
            background-color: #0079d3;
            color: white;
            border-color: #0079d3;
        }

        .btn-submit:hover {
            background-color: #0060a8;
            border-color: #0060a8;
        }

        /* Replies container */
        .replies-container {
            margin-top: 8px;
        }

        .show-more-replies {
            background: none;
            border: none;
            color: #0079d3;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 0;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .show-more-replies:hover {
            text-decoration: underline;
        }

        /* Nested comment styling */
        .comment-reply {
            border-left: none;
        }

        .comment-reply .comment-wrapper {
            padding-left: 0;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .comment-wrapper {
                padding: 8px 12px;
            }

            .comment-actions {
                flex-wrap: wrap;
            }

            .action-btn {
                font-size: 11px;
                padding: 3px 5px;
            }

            .reply-input-container {
                flex-direction: column;
                gap: 8px;
            }

            .reply-avatar {
                align-self: flex-start;
            }
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        .min-vh-75 {
            min-height: 75vh;
        }

        .btn-primary {
            background-color: #317a75;
            border-color: #317a75;
        }

        .btn-primary:hover {
            background-color: #2a6b66;
            border-color: #2a6b66;
        }

        .text-primary {
            color: #317a75 !important;
        }

        .bg-primary {
            background-color: #317a75 !important;
        }
    </style>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-white">

    @include('partials.user-navigation')

    <main class="mt-4 pt-5">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
