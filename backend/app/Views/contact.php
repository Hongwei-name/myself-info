<?php
// Contact info management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add'])) {
            // Add contact info
            $type = $_POST['type'];
            $value = $_POST['value'];
            $icon = $_POST['icon'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("INSERT INTO contact_info (type, value, icon) VALUES (?, ?, ?)");
                $stmt->execute([$type, $value, $icon]);
            } else {
                $sql = "INSERT INTO contact_info (type, value, icon) VALUES ('$type', '$value', '$icon')";
                $conn->query($sql);
            }
            $success = "联系信息添加成功";
        } elseif (isset($_POST['update'])) {
            // Update contact info
            $id = $_POST['id'];
            $type = $_POST['type'];
            $value = $_POST['value'];
            $icon = $_POST['icon'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("UPDATE contact_info SET type=?, value=?, icon=? WHERE id=?");
                $stmt->execute([$type, $value, $icon, $id]);
            } else {
                $sql = "UPDATE contact_info SET type='$type', value='$value', icon='$icon' WHERE id=$id";
                $conn->query($sql);
            }
            $success = "联系信息更新成功";
        } elseif (isset($_POST['delete'])) {
            // Delete contact info
            $id = $_POST['id'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("DELETE FROM contact_info WHERE id=?");
                $stmt->execute([$id]);
            } else {
                $sql = "DELETE FROM contact_info WHERE id=$id";
                $conn->query($sql);
            }
            $success = "联系信息删除成功";
        }
    } catch (Exception $e) {
        $error = "Operation failed: " . $e->getMessage();
    }
}

// Get contact info list
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM contact_info ORDER BY id ASC");
        $contacts = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT * FROM contact_info ORDER BY id ASC");
        $contacts = [];
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
    }
} catch (Exception $e) {
    $error = "Failed to get contact info: " . $e->getMessage();
    $contacts = [];
}

$conn = null;
?>
<div class="contact-management">
    <h2>联系信息管理</h2>
    <p>添加、编辑和删除联系信息</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <!-- 添加联系信息表单 -->
    <div class="card">
        <h3>添加联系信息</h3>
        <form method="POST" action="index.php?page=contact">
            <div class="form-group">
                <label for="type">类型</label>
                <input type="text" id="type" name="type" placeholder="例如：GitHub" required>
            </div>
            <div class="form-group">
                <label for="value">值</label>
                <input type="text" id="value" name="value" placeholder="例如：https://github.com/username" required>
            </div>
            <div class="form-group">
                <label for="icon">图标</label>
                <input type="text" id="icon" name="icon" placeholder="例如：📧" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">添加联系信息</button>
        </form>
    </div>
    
    <!-- 联系信息列表 -->
    <div class="card">
        <h3>联系信息列表</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>类型</th>
                    <th>值</th>
                    <th>图标</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) { ?>
                <tr>
                    <td><?php echo $contact['id']; ?></td>
                    <td><?php echo htmlspecialchars($contact['type']); ?></td>
                    <td><?php echo htmlspecialchars($contact['value']); ?></td>
                    <td><?php echo htmlspecialchars($contact['icon']); ?></td>
                    <td>
                        <button class="btn btn-secondary" onclick="editContact(<?php echo $contact['id']; ?>, '<?php echo addslashes($contact['type']); ?>', '<?php echo addslashes($contact['value']); ?>', '<?php echo addslashes($contact['icon']); ?>')">编辑</button>
                        <form method="POST" action="index.php?page=contact" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('确定要删除这个联系信息吗？');">删除</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <!-- 编辑联系信息模态框 -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>编辑联系信息</h3>
            </div>
            <form method="POST" action="index.php?page=contact">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editType">类型</label>
                    <input type="text" id="editType" name="type" required>
                </div>
                <div class="form-group">
                    <label for="editValue">值</label>
                    <input type="text" id="editValue" name="value" required>
                </div>
                <div class="form-group">
                    <label for="editIcon">图标</label>
                    <input type="text" id="editIcon" name="icon" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">保存更改</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').style.display = 'none'">取消</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function editContact(id, type, value, icon) {
            document.getElementById('editId').value = id;
            document.getElementById('editType').value = type;
            document.getElementById('editValue').value = value;
            document.getElementById('editIcon').value = icon;
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