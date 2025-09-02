<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (empty($_SESSION['user']['id'])) {
    header("Location: /login");
    header("Location: /login");
    exit;
}

$userId = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT avatar FROM users WHERE id = ?");
$stmt->execute([$userId]);
$avatar = $stmt->fetchColumn();

                $userAvatar = $avatar ?: 'default.png';
?>
<div class="profile-container">
    <div class="profile-sidebar">
        <div class="profile-card">
                <form action="/avatar" method="post" enctype="multipart/form-data">
        <label for="avatar-input" id="avatar" class="profile-photo">
                      <img src="/uploads/avatars/<?= htmlspecialchars($userAvatar) ?>?<?= time() ?>" alt="Аватар" class="image">
        <div class="photo-overlay">📷 Изменить</div>
</label>
        <input class="avatar-input" type="file" name="avatar" id="avatar-input" accept="image/*">
<button type="submit">Сохранить</button>
    </form>
<a href="/profileUpdate">Изменить</a>
                        <h2 class="profile-name">Александр Иванов</h2>
                        <p class="profile-title">Senior Frontend Developer</p>
                        <div class="profile-location">
                            📍 Москва, Россия
                        </div>
                        <div class="profile-status">
                            <span class="status-dot"></span>
                            Открыт к предложениям
                        </div>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-number">156</div>
                            <div class="stat-label">Просмотров</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">23</div>
                            <div class="stat-label">Отклики</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Интервью</div>
                        </div>
                    </div>

                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <div>
                                <div>a.ivanov@email.com</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">Email</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📱</div>
                            <div>
                                <div>+7 (999) 123-45-67</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">Телефон</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">💼</div>
                            <div>
                                <div>linkedin.com/in/aivanov</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">LinkedIn</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">🔗</div>
                            <div>
                                <div>github.com/aivanov</div>
                                <div style="font-size: 0.8rem; color: #6b7280;">GitHub</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<style>
.avatar-input{
        display: none;
     }
     .profile-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
    margin-top: 2rem;
            position: relative;
        }

        /* Profile Sidebar */
        .profile-sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
}

.profile-card {
    background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
    padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInLeft 0.8s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.profile-header {
    text-align: center;
    margin-bottom: 2rem;
}

.profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
}

.photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-size: 1rem;
        }

        .profile-photo:hover .photo-overlay {
            opacity: 1;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #1e3a8a, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .profile-title {
            color: #6b7280;
    font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .profile-location {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse 2s infinite;
}

/* Stats */
        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 15px;
            transition: all 0.3s ease;
}

.stat-item:hover {
    background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
    color: #667eea;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        /* Contact Info */
        .contact-info {
            margin-top: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
    border-radius: 10px;
            transition: all 0.3s ease;
    margin-bottom: 0.5rem;
}

.contact-item:hover {
    background: rgba(102, 126, 234, 0.05);
        }

        .contact-icon {
            width: 40px;
            height: 40px;
    border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
}
</style>