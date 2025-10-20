<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BanglaType - বাংলা টাইপিং পরীক্ষা</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Sans Bengali', 'Kalpurush', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0c0e1d 0%, #1a1f3b 100%);
            color: #f0f0f0;
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Navigation Bar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 5%;
            background: rgba(10, 12, 25, 0.9);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        nav.scrolled {
            padding: 0.8rem 5%;
            background: rgba(10, 12, 25, 0.95);
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #6c5ce7;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
            color: #ff9f43;
        }

        .logo i {
            margin-right: 10px;
            color: #ff9f43;
            transition: all 0.3s ease;
        }

        .logo:hover i {
            transform: rotate(15deg);
            color: #6c5ce7;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #ddd;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(45deg, #6c5ce7, #ff9f43);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #ff9f43;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .login-btn {
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff9f43, #fdcb6e);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
        }

        .login-btn:hover::before {
            left: 0;
        }

        .user-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .user-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
            border-color: #ff9f43;
        }

        /* User Sidebar */
        .user-sidebar {
            position: fixed;
            top: 0;
            right: -350px;
            width: 350px;
            height: 100vh;
            background: rgba(16, 19, 40, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.3);
            z-index: 1001;
            padding: 2rem;
            transition: right 0.4s ease;
            overflow-y: auto;
        }

        .user-sidebar.active {
            right: 0;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(108, 92, 231, 0.3);
        }

        .sidebar-header h2 {
            color: #fdcb6e;
            font-size: 1.5rem;
        }

        .close-sidebar {
            background: none;
            border: none;
            color: #b2bec3;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-sidebar:hover {
            color: #ff9f43;
        }

        .user-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1rem;
            border: 3px solid #ff9f43;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details {
            margin-bottom: 2rem;
        }

        .user-detail {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.8rem;
            background: rgba(26, 31, 59, 0.6);
            border-radius: 10px;
        }

        .user-detail i {
            color: #6c5ce7;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(45deg, #ff9f43, #fdcb6e);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 159, 67, 0.5);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Login Modal */
        .login-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 400px;
            background: rgba(16, 19, 40, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            z-index: 1002;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .login-modal.active {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            color: #fdcb6e;
        }

        .close-modal {
            background: none;
            border: none;
            color: #b2bec3;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #ff9f43;
        }

        .google-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.8rem;
            background: white;
            color: #757575;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .google-login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .google-login-btn img {
            width: 20px;
            margin-right: 10px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(108, 92, 231, 0.3);
        }

        .divider-text {
            padding: 0 1rem;
            color: #b2bec3;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #b2bec3;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(108, 92, 231, 0.3);
            border-radius: 8px;
            background: rgba(26, 31, 59, 0.6);
            color: white;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6c5ce7;
        }

        .modal-login-btn {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.5);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 6rem 5% 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(108, 92, 231, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(255, 159, 67, 0.15) 0%, transparent 40%);
            z-index: -1;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.8rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #ff9f43, #fdcb6e, #6c5ce7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: glow 2s infinite alternate;
            line-height: 1.2;
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px rgba(255, 159, 67, 0.5); }
            to { text-shadow: 0 0 20px rgba(255, 159, 67, 0.8), 0 0 30px rgba(108, 92, 231, 0.6); }
        }

        .hero p {
            font-size: 1.5rem;
            margin: 0 auto 3rem;
            color: #b2bec3;
            transition: all 0.3s ease;
            max-width: 700px;
            line-height: 1.6;
        }

        .hero p:hover {
            color: #f0f0f0;
            transform: scale(1.02);
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .primary-btn {
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        }

        .primary-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff9f43, #fdcb6e);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .primary-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.5);
        }

        .primary-btn:hover::before {
            left: 0;
        }

        .secondary-btn {
            background: transparent;
            color: #6c5ce7;
            border: 2px solid #6c5ce7;
        }

        .secondary-btn:hover {
            background: rgba(108, 92, 231, 0.1);
            transform: translateY(-5px) scale(1.05);
            color: #ff9f43;
            border-color: #ff9f43;
            box-shadow: 0 8px 25px rgba(255, 159, 67, 0.3);
        }

        .typing-demo {
            background: rgba(16, 19, 40, 0.8);
            padding: 2rem;
            border-radius: 15px;
            margin: 3rem auto 0;
            max-width: 700px;
            font-size: 1.4rem;
            line-height: 1.8;
            border-left: 4px solid #ff9f43;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .typing-demo::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #6c5ce7, #ff9f43, #6c5ce7);
            animation: gradientMove 3s infinite linear;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: rgba(26, 31, 59, 0.6);
            border-radius: 15px;
            width: 180px;
            transition: all 0.3s ease;
            border: 1px solid rgba(108, 92, 231, 0.3);
        }

        .stat-item:hover {
            transform: translateY(-5px);
            border-color: #ff9f43;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ff9f43;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #b2bec3;
        }

        /* Main Section */
        .main-section {
            padding: 5rem 5%;
            text-align: center;
            background: rgba(16, 19, 40, 0.8);
            margin: 2rem auto;
            border-radius: 20px;
            max-width: 1200px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #fdcb6e;
            transition: all 0.3s ease;
        }

        .main-section h2:hover {
            transform: scale(1.05);
            text-shadow: 0 0 15px rgba(253, 203, 110, 0.5);
        }

        .main-section p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            color: #dfe6e9;
            transition: all 0.3s ease;
        }

        .main-section p:hover {
            color: #ffffff;
            transform: scale(1.02);
        }

        .login-prompt {
            background: rgba(26, 31, 59, 0.6);
            padding: 2.5rem;
            border-radius: 15px;
            margin: 2rem auto;
            max-width: 600px;
            border: 1px solid #6c5ce7;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .login-prompt:hover {
            border-color: #ff9f43;
            box-shadow: 0 8px 25px rgba(255, 159, 67, 0.3);
            transform: translateY(-5px);
        }

        .login-prompt h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #a29bfe;
            transition: all 0.3s ease;
        }

        .login-prompt:hover h3 {
            color: #ff9f43;
            transform: scale(1.05);
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .feature {
            background: rgba(26, 31, 59, 0.6);
            padding: 2rem;
            border-radius: 15px;
            width: 280px;
            transition: all 0.3s ease;
            border: 1px solid rgba(108, 92, 231, 0.3);
            animation: fadeIn 1s ease-out;
            animation-fill-mode: backwards;
        }

        .feature:nth-child(1) { animation-delay: 0.2s; }
        .feature:nth-child(2) { animation-delay: 0.4s; }
        .feature:nth-child(3) { animation-delay: 0.6s; }

        .feature:hover {
            transform: translateY(-10px) scale(1.03);
            border-color: #ff9f43;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .feature i {
            font-size: 2.5rem;
            color: #6c5ce7;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .feature:hover i {
            color: #ff9f43;
            transform: scale(1.2) rotate(5deg);
        }

        .feature h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #fdcb6e;
            transition: all 0.3s ease;
        }

        .feature:hover h3 {
            color: #ff9f43;
        }

        .feature p {
            font-size: 1rem;
            color: #b2bec3;
            transition: all 0.3s ease;
        }

        .feature:hover p {
            color: #dfe6e9;
        }

        /* Footer */
        footer {
            background: #0a0c19;
            padding: 2.5rem 5%;
            text-align: center;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #6c5ce7, #ff9f43, #6c5ce7);
            animation: gradientMove 3s infinite linear;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #b2bec3;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .footer-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(45deg, #6c5ce7, #ff9f43);
            transition: width 0.3s ease;
        }

        .footer-links a:hover {
            color: #ff9f43;
        }

        .footer-links a:hover::after {
            width: 100%;
        }

        .copyright {
            color: #636e72;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .copyright:hover {
            color: #f0f0f0;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .hero p {
                font-size: 1.3rem;
            }
            
            .stats {
                gap: 2rem;
            }
            
            .stat-item {
                width: 150px;
                padding: 1.2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }

            .user-sidebar {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 8rem 5% 3rem;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .nav-links {
                gap: 1.2rem;
                font-size: 0.9rem;
            }
            
            .features {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .login-btn {
                padding: 0.5rem 1.2rem;
                font-size: 0.9rem;
            }
            
            .cta-btn {
                width: 100%;
                max-width: 250px;
            }
            
            .stats {
                gap: 1rem;
            }
            
            .stat-item {
                width: 130px;
                padding: 1rem;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .stat-label {
                font-size: 1rem;
            }

            .login-modal {
                width: 90%;
                max-width: 350px;
            }

            .user-sidebar {
                width: 280px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav id="navbar">
        <div class="logo">
            <i class="fas fa-keyboard"></i>
            <span>BanglaType</span>
        </div>
        <div class="nav-links">
            <a href="#">টেস্ট</a>
            <a href="#">লিডারবোর্ড</a>
            <a href="#">হেল্প</a>
        </div>
        <div id="auth-button">
            <button class="login-btn" id="login-button">লগইন</button>
            <div class="user-icon" id="user-icon" style="display: none;">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </nav>

    <!-- User Sidebar -->
    <div class="user-sidebar" id="user-sidebar">
        <div class="sidebar-header">
            <h2>প্রোফাইল</h2>
            <button class="close-sidebar" id="close-sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                <img id="sidebar-avatar" src="" alt="User Avatar">
            </div>
            <h3 id="sidebar-username">ইউজারের নাম</h3>
        </div>
        <div class="user-details">
            <div class="user-detail">
                <i class="fas fa-user"></i>
                <span id="sidebar-fullname">ইউজারের পূর্ণ নাম</span>
            </div>
            <div class="user-detail">
                <i class="fas fa-envelope"></i>
                <span id="sidebar-email">user@example.com</span>
            </div>
            <div class="user-detail">
                <i class="fas fa-calendar-alt"></i>
                <span id="sidebar-join-date">জানুয়ারি ১, ২০২৩</span>
            </div>
        </div>
        <button class="logout-btn" id="logout-button">
            <i class="fas fa-sign-out-alt"></i> লগআউট
        </button>
    </div>

    <!-- Login Modal -->
    <div class="login-modal" id="login-modal">
        <div class="modal-header">
            <h2>লগইন</h2>
            <button class="close-modal" id="close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <button class="google-login-btn" id="google-login-btn">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=" alt="Google">
            Google-এর সাথে লগইন
        </button>
        
        <div class="divider">
            <div class="divider-line"></div>
            <div class="divider-text">বা</div>
            <div class="divider-line"></div>
        </div>
        
        <div class="form-group">
            <label for="email">ইমেইল</label>
            <input type="email" id="email" placeholder="আপনার ইমেইল লিখুন">
        </div>
        <div class="form-group">
            <label for="password">পাসওয়ার্ড</label>
            <input type="password" id="password" placeholder="আপনার পাসওয়ার্ড লিখুন">
        </div>
        <button class="modal-login-btn" id="modal-login-btn">লগইন</button>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>আপনার বাংলা টাইপিং দক্ষতা পরীক্ষা করুন</h1>
            <p>দ্রুত এবং নির্ভুলভাবে বাংলা টাইপিং শেখার ও অনুশীলনের সর্বোত্তম প্ল্যাটফর্ম</p>
            <div class="hero-buttons">
                <button class="cta-btn primary-btn">এখনই শুরু করুন</button>
                <button class="cta-btn secondary-btn">আরও জানুন</button>
            </div>
            
            <div class="typing-demo">
                <p>বাংলা ভাষায় টাইপিং দক্ষতা উন্নত করুন</p>
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">১০,০০০+</div>
                    <div class="stat-label">ব্যবহারকারী</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">৯৫%</div>
                    <div class="stat-label">সাফল্যের হার</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">৫০+</div>
                    <div class="stat-label">টাইপিং টেস্ট</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Section -->
    <section class="main-section">
        <h2>আপনার টাইপিং দক্ষতা যাচাই করুন</h2>
        <p>বাংলা टাইपिंग গতি এবং নির্ভুলতা পরিমাপ করতে আমাদের ইন্টারেক্টিভ টেস্ট ব্যবহার করুন। বিনামূল্যে নিবন্ধন করুন এবং আপনার উন্নতি ট্র্যাক করুন।</p>
        
        <div class="login-prompt">
            <h3>টেস্ট শুরু করতে লগইন করুন</h3>
            <p>আপনার টাইপিং পরীক্ষা শুরু করতে বা লিডারবোর্ড দেখতে দয়া করে লগইন করুন</p>
            <button class="cta-btn primary-btn" id="main-login-button">লগইন করুন</button>
        </div>
        
        <div class="features">
            <div class="feature">
                <i class="fas fa-tachometer-alt"></i>
                <h3>গতি পরিমাপ</h3>
                <p>প্রতি মিনিটে শব্দ (WPM) এবং প্রতি মিনিটে অক্ষর (CPM) হিসাবে আপনার গতি পরিমাপ করুন</p>
            </div>
            <div class="feature">
                <i class="fas fa-bullseye"></i>
                <h3>নির্ভুলতা বিশ্লেষণ</h3>
                <p>আপনার টাইপিং নির্ভুলতা বিশ্লেষণ করুন এবং উন্নতির জন্য পরামর্শ পান</p>
            </div>
            <div class="feature">
                <i class="fas fa-trophy"></i>
                <h3>লিডারবোর্ড</h3>
                <p>বিশ্বব্যাপী ব্যবহারকারীদের সাথে নিজের দক্ষতা তুলনা করুন এবং শীর্ষ স্থান দখল করুন</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#">প্রাইভেসি পলিসি</a>
                <a href="#">টার্মস অফ সার্ভিস</a>
                <a href="#">যোগাযোগ</a>
                <a href="#">সাপোর্ট</a>
            </div>
            <div class="copyright">
                &copy; ২০২৩ BanglaType. সকল права সংরক্ষিত।
            </div>
        </div>
    </footer>

    <script>
        // Check if user is logged in (from localStorage)
        const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        const userData = JSON.parse(localStorage.getItem('userData') || '{}');

        // DOM Elements
        const loginButton = document.getElementById('login-button');
        const userIcon = document.getElementById('user-icon');
        const userSidebar = document.getElementById('user-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const overlay = document.getElementById('overlay');
        const loginModal = document.getElementById('login-modal');
        const closeModal = document.getElementById('close-modal');
        const googleLoginBtn = document.getElementById('google-login-btn');
        const modalLoginBtn = document.getElementById('modal-login-btn');
        const mainLoginButton = document.getElementById('main-login-button');
        const logoutButton = document.getElementById('logout-button');

        // Initialize UI based on login status
        function initUI() {
            if (isLoggedIn) {
                loginButton.style.display = 'none';
                userIcon.style.display = 'flex';
                
                // Populate user data in sidebar
                document.getElementById('sidebar-username').textContent = userData.username || 'ইউজারের নাম';
                document.getElementById('sidebar-fullname').textContent = userData.fullname || 'ইউজারের পূর্ণ নাম';
                document.getElementById('sidebar-email').textContent = userData.email || 'user@example.com';
                document.getElementById('sidebar-join-date').textContent = userData.joinDate || 'জানুয়ারি ১, ২০২৩';
                
                // Set avatar if available
                if (userData.avatar) {
                    document.getElementById('sidebar-avatar').src = userData.avatar;
                } else {
                    document.getElementById('sidebar-avatar').src = '';
                    document.getElementById('sidebar-avatar').parentNode.innerHTML = '<i class="fas fa-user"></i>';
                }
            } else {
                loginButton.style.display = 'block';
                userIcon.style.display = 'none';
            }
        }

        // Show login modal
        function showLoginModal() {
            loginModal.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Hide login modal
        function hideLoginModal() {
            loginModal.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Show user sidebar
        function showUserSidebar() {
            userSidebar.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Hide user sidebar
        function hideUserSidebar() {
            userSidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Google Login function
        function loginWithGoogle() {
            // Simulate Google OAuth process
            document.getElementById('google-login-btn').innerHTML = '<i class="fas fa-spinner fa-spin"></i> লগইন হচ্ছে...';
            
            setTimeout(() => {
                // Simulate successful Google login
                const userData = {
                    username: 'বাংলা টাইপার',
                    fullname: 'বাংলা টাইপার',
                    email: 'bengaltyper@example.com',
                    joinDate: 'আগস্ট ২২, ২০২৩',
                    avatar: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80'
                };
                
                // Save to localStorage
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userData', JSON.stringify(userData));
                
                // Update UI
                initUI();
                hideLoginModal();
                
                // Show success message
                alert('Google-এর মাধ্যমে সফলভাবে লগইন করা হয়েছে!');
            }, 1500);
        }

        // Regular login function
        function login() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (email && password) {
                // Simulate login success
                const userData = {
                    username: 'বাংলা টাইপার',
                    fullname: 'বাংলা টাইপার',
                    email: email,
                    joinDate: 'আগস্ট ২২, ২০২৩'
                };
                
                // Save to localStorage
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userData', JSON.stringify(userData));
                
                // Update UI
                initUI();
                hideLoginModal();
                
                // Show success message
                alert('সফলভাবে লগইন করা হয়েছে!');
            } else {
                alert('দয়া করে ইমেইল এবং পাসওয়ার্ড লিখুন');
            }
        }

        // Logout function
        function logout() {
            // Clear localStorage
            localStorage.setItem('isLoggedIn', 'false');
            localStorage.removeItem('userData');
            
            // Update UI
            initUI();
            hideUserSidebar();
            
            // Show logout message
            alert('সফলভাবে লগআউট করা হয়েছে!');
        }

        // Event Listeners
        loginButton.addEventListener('click', showLoginModal);
        userIcon.addEventListener('click', showUserSidebar);
        closeSidebar.addEventListener('click', hideUserSidebar);
        closeModal.addEventListener('click', hideLoginModal);
        overlay.addEventListener('click', function() {
            hideLoginModal();
            hideUserSidebar();
        });
        googleLoginBtn.addEventListener('click', loginWithGoogle);
        modalLoginBtn.addEventListener('click', login);
        mainLoginButton.addEventListener('click', showLoginModal);
        logoutButton.addEventListener('click', logout);

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Initialize UI on page load
        initUI();
    </script>
</body>
</html>