<?php
// Experiences management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add'])) {
            // Add experience
            $date = $_POST['date'];
            $title = $_POST['title'];
            $company = $_POST['company'];
            $description = $_POST['description'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("INSERT INTO experiences (date, title, company, description) VALUES (?, ?, ?, ?)");
                $stmt->execute([$date, $title, $company, $description]);
            } else {
                $sql = "INSERT INTO experiences (date, title, company, description) VALUES ('$date', '$title', '$company', '$description')";
                $conn->query($sql);
            }
            $success = "Experience added successfully";
        } elseif (isset($_POST['update'])) {
            // Update experience
            $id = $_POST['id'];
            $date = $_POST['date'];
            $title = $_POST['title'];
            $company = $_POST['company'];
            $description = $_POST['description'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("UPDATE experiences SET date=?, title=?, company=?, description=? WHERE id=?");
                $stmt->execute([$date, $title, $company, $description, $id]);
            } else {
                $sql = "UPDATE experiences SET date='$date', title='$title', company='$company', description='$description' WHERE id=$id";
                $conn->query($sql);
            }
            $success = "Experience updated successfully";
        } elseif (isset($_POST['delete'])) {
            // Delete experience
            $id = $_POST['id'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("DELETE FROM experiences WHERE id=?");
                $stmt->execute([$id]);
            } else {
                $sql = "DELETE FROM experiences WHERE id=$id";
                $conn->query($sql);
            }
            $success = "Experience deleted successfully";
        }
    } catch (Exception $e) {
        $error = "Operation failed: " . $e->getMessage();
    }
}

// Get experiences list
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM experiences ORDER BY id DESC");
        $experiences = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT * FROM experiences ORDER BY id DESC");
        $experiences = [];
        while ($row = $result->fetch_assoc()) {
            $experiences[] = $row;
        }
    }
} catch (Exception $e) {
    $error = "Failed to get experiences: " . $e->getMessage();
    $experiences = [];
}

$conn = null;
?>
<div class="experiences-management">
    <h2>工作经历管理</h2>
    <p>添加、编辑和删除工作经历</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <!-- 添加工作经历表单 -->
    <div class="card">
        <h3>添加工作经历</h3>
        <form method="POST" action="index.php?page=experiences">
            <div class="form-group">
                <label for="date">日期</label>
                <input type="text" id="date" name="date" placeholder="例如：2024 - 至今" required>
            </div>
            <div class="form-group">
                <label for="title">职位</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="company">公司/机构</label>
                <input type="text" id="company" name="company" required>
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit" name="add" class="btn btn-primary">添加工作经历</button>
        </form>
    </div>
    
    <!-- 工作经历列表 -->
    <div class="card">
        <h3>工作经历列表</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>日期</th>
                    <th>职位</th>
                    <th>公司/机构</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($experiences as $experience) { ?>
                <tr>
                    <td><?php echo $experience['id']; ?></td>
                    <td><?php echo htmlspecialchars($experience['date']); ?></td>
                    <td><?php echo htmlspecialchars($experience['title']); ?></td>
                    <td><?php echo htmlspecialchars($experience['company']); ?></td>
                    <td><?php echo substr(htmlspecialchars($experience['description']), 0, 50); ?>...</td>
                    <td>
                        <button class="btn btn-secondary" onclick="editExperience(<?php echo $experience['id']; ?>, '<?php echo addslashes($experience['date']); ?>', '<?php echo addslashes($experience['title']); ?>', '<?php echo addslashes($experience['company']); ?>', '<?php echo addslashes($experience['description']); ?>')">编辑</button>
                        <form method="POST" action="index.php?page=experiences" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $experience['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('确定要删除这个工作经历吗？');">删除</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <!-- 编辑工作经历模态框 -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>编辑工作经历</h3>
            </div>
            <form method="POST" action="index.php?page=experiences">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editDate">日期</label>
                    <input type="text" id="editDate" name="date" required>
                </div>
                <div class="form-group">
                    <label for="editTitle">职位</label>
                    <input type="text" id="editTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="editCompany">公司/机构</label>
                    <input type="text" id="editCompany" name="company" required>
                </div>
                <div class="form-group">
                    <label for="editDescription">描述</label>
                    <textarea id="editDescription" name="description" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">保存更改</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').style.display = 'none'">取消</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function editExperience(id, date, title, company, description) {
            document.getElementById('editId').value = id;
            document.getElementById('editDate').value = date;
            document.getElementById('editTitle').value = title;
            document.getElementById('editCompany').value = company;
            document.getElementById('editDescription').value = description;
            document.getElementById('editModal').style.display = 'block';
        }
        
        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</div>