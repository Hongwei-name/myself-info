<?php
// 管理后台主页面
// 获取当前页面
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理后台 - 个人网站</title>
    <link rel="stylesheet" href="public/css/style.css">
    <meta name="description" content="陈洪伟个人网站管理后台">
    <meta name="author" content="陈洪伟">
</head>
<body>
    <div class="admin-container">
        <!-- 侧边栏导航 -->
        <aside class="sidebar" role="navigation" aria-label="主导航">
            <div class="sidebar-header">
                <h2>管理后台</h2>
                <p>陈洪伟个人网站</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="index.php?page=dashboard" class="nav-item <?php echo $page == 'dashboard' ? 'active' : ''; ?>"><span class="nav-icon">📊</span> 仪表盘</a></li>
                    <li><a href="index.php?page=personal" class="nav-item <?php echo $page == 'personal' ? 'active' : ''; ?>"><span class="nav-icon">👤</span> 个人信息</a></li>
                    <li><a href="index.php?page=skills" class="nav-item <?php echo $page == 'skills' ? 'active' : ''; ?>"><span class="nav-icon">💪</span> 技能管理</a></li>
                    <li><a href="index.php?page=experiences" class="nav-item <?php echo $page == 'experiences' ? 'active' : ''; ?>"><span class="nav-icon">💼</span> 工作经历</a></li>
                    <li><a href="index.php?page=education" class="nav-item <?php echo $page == 'education' ? 'active' : ''; ?>"><span class="nav-icon">🎓</span> 教育背景</a></li>
                    <li><a href="index.php?page=projects" class="nav-item <?php echo $page == 'projects' ? 'active' : ''; ?>"><span class="nav-icon">📁</span> 项目管理</a></li>
                    <li><a href="index.php?page=contact" class="nav-item <?php echo $page == 'contact' ? 'active' : ''; ?>"><span class="nav-icon">📞</span> 联系信息</a></li>
                </ul>
            </nav>
        </aside>

        <!-- 主内容区域 -->
        <main class="main-content" role="main">
            <header class="main-header" role="banner">
                <h1>欢迎回来，陈洪伟</h1>
                <p>管理您的个人网站内容</p>
            </header>
            <div class="content-area">
                <?php
                // 根据page参数加载不同的内容
                switch($page) {
                    case 'personal':
                        include 'app/Views/personal.php';
                        break;
                    case 'skills':
                        include 'app/Views/skills.php';
                        break;
                    case 'experiences':
                        include 'app/Views/experiences.php';
                        break;
                    case 'education':
                        include 'app/Views/education.php';
                        break;
                    case 'projects':
                        include 'app/Views/projects.php';
                        break;
                    case 'contact':
                        include 'app/Views/contact.php';
                        break;
                    default:
                        include 'app/Views/dashboard.php';
                        break;
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>