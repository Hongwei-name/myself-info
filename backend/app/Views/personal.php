<?php
// Personal info management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $slogan = $_POST['slogan'];
    $description = $_POST['description'];
    $avatar = $_POST['avatar'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $university = $_POST['university'];
    $major = $_POST['major'];
    $english_cert = $_POST['english_cert'];
    $web_cert = $_POST['web_cert'];
    $education_courses = $_POST['education_courses'] ?? '';
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE personal_info SET name=?, title=?, slogan=?, description=?, avatar=?, phone=?, email=?, university=?, major=?, english_cert=?, web_cert=?, education_courses=? WHERE id=1");
            $stmt->execute([$name, $title, $slogan, $description, $avatar, $phone, $email, $university, $major, $english_cert, $web_cert, $education_courses]);
        } else {
            $sql = "UPDATE personal_info SET name='$name', title='$title', slogan='$slogan', description='$description', avatar='$avatar', phone='$phone', email='$email', university='$university', major='$major', english_cert='$english_cert', web_cert='$web_cert', education_courses='$education_courses' WHERE id=1";
            $conn->query($sql);
        }
        $success = "个人信息更新成功";
    } catch (Exception $e) {
        $error = "更新失败: " . $e->getMessage();
    }
}

// Get personal info
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM personal_info WHERE id=1");
        $personal_info = $stmt->fetch();
    } else {
        $result = $conn->query("SELECT * FROM personal_info WHERE id=1");
        $personal_info = $result->fetch_assoc();
    }
} catch (Exception $e) {
    $error = "Failed to get personal info: " . $e->getMessage();
    $personal_info = [];
}

$conn = null;
?>
<div class="personal-info">
    <h2>个人信息管理</h2>
    <p>编辑您的个人信息</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <form method="POST" action="index.php?page=personal">
        <div class="card">
            <h3>基本信息</h3>
            <div class="form-group">
                <label for="name">姓名</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($personal_info['name'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="title">职位</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($personal_info['title'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="slogan">口号</label>
                <input type="text" id="slogan" name="slogan" value="<?php echo htmlspecialchars($personal_info['slogan'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">个人描述</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($personal_info['description'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="avatar">头像URL</label>
                <input type="text" id="avatar" name="avatar" value="<?php echo htmlspecialchars($personal_info['avatar'] ?? ''); ?>" required>
            </div>
        </div>
        
        <div class="card">
            <h3>联系信息</h3>
            <div class="form-group">
                <label for="phone">电话</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($personal_info['phone'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">邮箱</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($personal_info['email'] ?? ''); ?>" required>
            </div>
        </div>
        
        <div class="card">
            <h3>教育信息</h3>
            <div class="form-group">
                <label for="university">学校</label>
                <input type="text" id="university" name="university" value="<?php echo htmlspecialchars($personal_info['university'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="major">专业</label>
                <input type="text" id="major" name="major" value="<?php echo htmlspecialchars($personal_info['major'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="english_cert">英语证书</label>
                <input type="text" id="english_cert" name="english_cert" value="<?php echo htmlspecialchars($personal_info['english_cert'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="web_cert">Web工程师证书</label>
                <input type="text" id="web_cert" name="web_cert" value="<?php echo htmlspecialchars($personal_info['web_cert'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="education_courses">教育课程</label>
                <textarea id="education_courses" name="education_courses"><?php echo htmlspecialchars($personal_info['education_courses'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">保存更改</button>
    </form>
</div>