<?php
// Skills management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// 辅助函数：获取或创建技能分类
function getOrCreateCategory($conn, $category_name) {
    $category_id = null;
    
    // 查找现有分类
    if (isPDO($conn)) {
        $stmt = $conn->prepare("SELECT id FROM skill_categories WHERE name = ?");
        $stmt->execute([$category_name]);
        $result = $stmt->fetch();
        if ($result) {
            $category_id = $result['id'];
        }
    } else {
        $result = $conn->query("SELECT id FROM skill_categories WHERE name = '$category_name'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $category_id = $row['id'];
        }
    }
    
    // 如果分类不存在，创建新分类
    if (!$category_id) {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO skill_categories (name) VALUES (?)");
            $stmt->execute([$category_name]);
            $category_id = $conn->lastInsertId();
        } else {
            $conn->query("INSERT INTO skill_categories (name) VALUES ('$category_name')");
            $category_id = $conn->insert_id;
        }
    }
    
    return $category_id;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add'])) {
            // Add skill
            $name = $_POST['name'];
            $level = $_POST['level'];
            $category_name = $_POST['category_name'];
            
            // 获取或创建分类
            $category_id = getOrCreateCategory($conn, $category_name);
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("INSERT INTO skills (name, level, category_id) VALUES (?, ?, ?)");
                $stmt->execute([$name, $level, $category_id]);
            } else {
                $sql = "INSERT INTO skills (name, level, category_id) VALUES ('$name', '$level', '$category_id')";
                $conn->query($sql);
            }
            $success = "技能添加成功";
        } elseif (isset($_POST['update'])) {
            // Update skill
            $id = $_POST['id'];
            $name = $_POST['name'];
            $level = $_POST['level'];
            $category_name = $_POST['category_name'];
            
            // 获取或创建分类
            $category_id = getOrCreateCategory($conn, $category_name);
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("UPDATE skills SET name=?, level=?, category_id=? WHERE id=?");
                $stmt->execute([$name, $level, $category_id, $id]);
            } else {
                $sql = "UPDATE skills SET name='$name', level='$level', category_id='$category_id' WHERE id=$id";
                $conn->query($sql);
            }
            $success = "技能更新成功";
        } elseif (isset($_POST['delete'])) {
            // Delete skill
            $id = $_POST['id'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("DELETE FROM skills WHERE id=?");
                $stmt->execute([$id]);
            } else {
                $sql = "DELETE FROM skills WHERE id=$id";
                $conn->query($sql);
            }
            $success = "技能删除成功";
        }
    } catch (Exception $e) {
        $error = "操作失败: " . $e->getMessage();
    }
}

// Get skill categories
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM skill_categories ORDER BY name ASC");
        $categories = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT * FROM skill_categories ORDER BY name ASC");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
} catch (Exception $e) {
    $error = "获取技能分类失败: " . $e->getMessage();
    $categories = [];
}

// Get skills list with categories
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT s.*, c.name as category_name FROM skills s LEFT JOIN skill_categories c ON s.category_id = c.id ORDER BY s.id ASC");
        $skills = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT s.*, c.name as category_name FROM skills s LEFT JOIN skill_categories c ON s.category_id = c.id ORDER BY s.id ASC");
        $skills = [];
        while ($row = $result->fetch_assoc()) {
            $skills[] = $row;
        }
    }
} catch (Exception $e) {
        $error = "获取技能失败: " . $e->getMessage();
        $skills = [];
}

$conn = null;
?>
<div class="skills-management">
    <h2>技能管理</h2>
    <p>添加、编辑和删除技能</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <!-- 添加技能表单 -->
    <div class="card">
        <h3>添加技能</h3>
        <form method="POST" action="index.php?page=skills" onsubmit="return validateSkillForm()">
            <div class="form-group">
                <label for="name">技能名称</label>
                <input type="text" id="name" name="name" required aria-required="true">
                <div class="error-message" id="name-error"></div>
            </div>
            <div class="form-group">
                <label for="level">熟练度</label>
                <input type="text" id="level" name="level" placeholder="例如：90%" required aria-required="true">
                <div class="error-message" id="level-error"></div>
            </div>
            <div class="form-group">
                <label for="category_name">技能分类</label>
                <input type="text" id="category_name" name="category_name" placeholder="例如：前端开发、人工智能等" required aria-required="true">
                <div class="error-message" id="category-error"></div>
            </div>
            <button type="submit" name="add" class="btn btn-primary" id="add-skill-btn">
                <span class="btn-text">添加技能</span>
                <span class="loading" style="display: none;"></span>
            </button>
        </form>
    </div>
    
    <!-- 技能列表 -->
    <div class="card">
        <h3>技能列表</h3>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>技能名称</th>
                        <th>熟练度</th>
                        <th>技能分类</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($skills)) { ?>
                    <tr>
                        <td colspan="5" class="empty-cell">
                            <div class="empty-state">
                                <div class="empty-icon">📋</div>
                                <h3>暂无技能数据</h3>
                                <p>点击上方的"添加技能"按钮开始添加技能</p>
                            </div>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <?php foreach ($skills as $skill) { ?>
                    <tr>
                        <td><?php echo $skill['id']; ?></td>
                        <td><?php echo htmlspecialchars($skill['name']); ?></td>
                        <td><?php echo htmlspecialchars($skill['level']); ?></td>
                        <td>
                            <span class="category-badge"><?php echo htmlspecialchars($skill['category_name'] ?? '未分类'); ?></span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-secondary btn-sm" onclick="editSkill(<?php echo $skill['id']; ?>, '<?php echo addslashes($skill['name']); ?>', '<?php echo addslashes($skill['level']); ?>', '<?php echo addslashes($skill['category_name'] ?? '未分类'); ?>')">编辑</button>
                                <form method="POST" action="index.php?page=skills" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('确定要删除这个技能吗？')">删除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- 编辑技能模态框 -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>编辑技能</h3>
            </div>
            <form method="POST" action="index.php?page=skills">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editName">技能名称</label>
                    <input type="text" id="editName" name="name" required aria-required="true">
                    <div class="error-message" id="editName-error"></div>
                </div>
                <div class="form-group">
                    <label for="editLevel">熟练度</label>
                    <input type="text" id="editLevel" name="level" required aria-required="true">
                    <div class="error-message" id="editLevel-error"></div>
                </div>
                <div class="form-group">
                    <label for="editCategoryName">技能分类</label>
                    <input type="text" id="editCategoryName" name="category_name" placeholder="例如：前端开发、人工智能等" required aria-required="true">
                    <div class="error-message" id="editCategoryName-error"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">
                        <span class="btn-text">保存更改</span>
                        <span class="loading" style="display: none;"></span>
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').style.display = 'none'">取消</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function editSkill(id, name, level, category_name) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editLevel').value = level;
            document.getElementById('editCategoryName').value = category_name;
            document.getElementById('editModal').style.display = 'block';
        }
        
        window.onclick = function(event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>

    <script>
        // 表单验证
        function validateSkillForm() {
            // 重置错误信息
            document.getElementById('name-error').textContent = '';
            document.getElementById('level-error').textContent = '';
            document.getElementById('category-error').textContent = '';
            
            // 获取表单值
            const name = document.getElementById('name').value.trim();
            const level = document.getElementById('level').value.trim();
            const category = document.getElementById('category_name').value.trim();
            
            // 验证
            let isValid = true;
            
            if (name === '') {
                document.getElementById('name-error').textContent = '请输入技能名称';
                isValid = false;
            }
            
            if (level === '') {
                document.getElementById('level-error').textContent = '请输入熟练度';
                isValid = false;
            } else if (!/^\d+%$/.test(level) && !/^\d+$/.test(level)) {
                document.getElementById('level-error').textContent = '熟练度格式不正确，例如：90% 或 90';
                isValid = false;
            }
            
            if (category === '') {
                document.getElementById('category-error').textContent = '请输入技能分类';
                isValid = false;
            }
            
            // 如果验证通过，显示加载状态
            if (isValid) {
                const btn = document.getElementById('add-skill-btn');
                const btnText = btn.querySelector('.btn-text');
                const loading = btn.querySelector('.loading');
                
                btnText.style.display = 'none';
                loading.style.display = 'inline-block';
                btn.disabled = true;
            }
            
            return isValid;
        }
        
        // 编辑技能表单验证
        function validateEditSkillForm() {
            // 重置错误信息
            document.getElementById('editName-error').textContent = '';
            document.getElementById('editLevel-error').textContent = '';
            document.getElementById('editCategoryName-error').textContent = '';
            
            // 获取表单值
            const name = document.getElementById('editName').value.trim();
            const level = document.getElementById('editLevel').value.trim();
            const category = document.getElementById('editCategoryName').value.trim();
            
            // 验证
            let isValid = true;
            
            if (name === '') {
                document.getElementById('editName-error').textContent = '请输入技能名称';
                isValid = false;
            }
            
            if (level === '') {
                document.getElementById('editLevel-error').textContent = '请输入熟练度';
                isValid = false;
            } else if (!/^\d+%$/.test(level) && !/^\d+$/.test(level)) {
                document.getElementById('editLevel-error').textContent = '熟练度格式不正确，例如：90% 或 90';
                isValid = false;
            }
            
            if (category === '') {
                document.getElementById('editCategoryName-error').textContent = '请输入技能分类';
                isValid = false;
            }
            
            // 如果验证通过，显示加载状态
            if (isValid) {
                const btn = document.querySelector('#editModal button[type="submit"]');
                const btnText = btn.querySelector('.btn-text');
                const loading = btn.querySelector('.loading');
                
                if (btnText && loading) {
                    btnText.style.display = 'none';
                    loading.style.display = 'inline-block';
                    btn.disabled = true;
                }
            }
            
            return isValid;
        }
        
        // 为编辑模态框添加验证
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.querySelector('#editModal form');
            if (editForm) {
                editForm.onsubmit = validateEditSkillForm;
            }
        });
    </script>
</div>