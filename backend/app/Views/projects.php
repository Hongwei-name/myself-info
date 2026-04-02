<?php
// Projects management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add'])) {
            // Add project
            $title = $_POST['title'];
            $description = $_POST['description'];
            $technologies = $_POST['technologies'];
            $image = $_POST['image'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("INSERT INTO projects (title, description, technologies, image) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $description, $technologies, $image]);
            } else {
                $sql = "INSERT INTO projects (title, description, technologies, image) VALUES ('$title', '$description', '$technologies', '$image')";
                $conn->query($sql);
            }
            $success = "Project added successfully";
        } elseif (isset($_POST['update'])) {
            // Update project
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $technologies = $_POST['technologies'];
            $image = $_POST['image'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, technologies=?, image=? WHERE id=?");
                $stmt->execute([$title, $description, $technologies, $image, $id]);
            } else {
                $sql = "UPDATE projects SET title='$title', description='$description', technologies='$technologies', image='$image' WHERE id=$id";
                $conn->query($sql);
            }
            $success = "Project updated successfully";
        } elseif (isset($_POST['delete'])) {
            // Delete project
            $id = $_POST['id'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
                $stmt->execute([$id]);
            } else {
                $sql = "DELETE FROM projects WHERE id=$id";
                $conn->query($sql);
            }
            $success = "Project deleted successfully";
        }
    } catch (Exception $e) {
        $error = "Operation failed: " . $e->getMessage();
    }
}

// Get projects list
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC");
        $projects = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
} catch (Exception $e) {
    $error = "Failed to get projects: " . $e->getMessage();
    $projects = [];
}

$conn = null;
?>
<div class="projects-management">
    <h2>项目管理</h2>
    <p>添加、编辑和删除项目</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <!-- 添加项目表单 -->
    <div class="card">
        <h3>添加项目</h3>
        <form method="POST" action="index.php?page=projects">
            <div class="form-group">
                <label for="title">项目标题</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">项目描述</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="technologies">技术栈</label>
                <input type="text" id="technologies" name="technologies" placeholder="例如：Vue 3, TypeScript, Vuex" required>
            </div>
            <div class="form-group">
                <label for="image">项目图片URL</label>
                <input type="text" id="image" name="image" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">添加项目</button>
        </form>
    </div>
    
    <!-- 项目列表 -->
    <div class="card">
        <h3>项目列表</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>项目标题</th>
                    <th>描述</th>
                    <th>技术栈</th>
                    <th>图片</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><?php echo $project['id']; ?></td>
                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                    <td><?php echo substr(htmlspecialchars($project['description']), 0, 50); ?>...</td>
                    <td><?php echo htmlspecialchars($project['technologies']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($project['image']); ?>" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px;"></td>
                    <td>
                        <button class="btn btn-secondary" onclick="editProject(<?php echo $project['id']; ?>, '<?php echo addslashes($project['title']); ?>', '<?php echo addslashes($project['description']); ?>', '<?php echo addslashes($project['technologies']); ?>', '<?php echo addslashes($project['image']); ?>')">编辑</button>
                        <form method="POST" action="index.php?page=projects" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('确定要删除这个项目吗？');">删除</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <!-- 编辑项目模态框 -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>编辑项目</h3>
            </div>
            <form method="POST" action="index.php?page=projects">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editTitle">项目标题</label>
                    <input type="text" id="editTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="editDescription">项目描述</label>
                    <textarea id="editDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editTechnologies">技术栈</label>
                    <input type="text" id="editTechnologies" name="technologies" required>
                </div>
                <div class="form-group">
                    <label for="editImage">项目图片URL</label>
                    <input type="text" id="editImage" name="image" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">保存更改</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').style.display = 'none'">取消</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function editProject(id, title, description, technologies, image) {
            document.getElementById('editId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editTechnologies').value = technologies;
            document.getElementById('editImage').value = image;
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