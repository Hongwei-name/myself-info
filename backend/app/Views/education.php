<?php
// Education management page
require_once 'config/database.php';

$conn = getDBConnection();
$success = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['add'])) {
            // Add education
            $institution = $_POST['institution'];
            $degree = $_POST['degree'];
            $major = $_POST['major'];
            $start_year = $_POST['start_year'];
            $end_year = $_POST['end_year'];
            $courses = $_POST['courses'];
            $description = $_POST['description'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("INSERT INTO education (institution, degree, major, start_year, end_year, courses, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$institution, $degree, $major, $start_year, $end_year, $courses, $description]);
            } else {
                $sql = "INSERT INTO education (institution, degree, major, start_year, end_year, courses, description) VALUES ('$institution', '$degree', '$major', '$start_year', '$end_year', '$courses', '$description')";
                $conn->query($sql);
            }
            $success = "教育背景添加成功";
        } elseif (isset($_POST['update'])) {
            // Update education
            $id = $_POST['id'];
            $institution = $_POST['institution'];
            $degree = $_POST['degree'];
            $major = $_POST['major'];
            $start_year = $_POST['start_year'];
            $end_year = $_POST['end_year'];
            $courses = $_POST['courses'];
            $description = $_POST['description'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("UPDATE education SET institution=?, degree=?, major=?, start_year=?, end_year=?, courses=?, description=? WHERE id=?");
                $stmt->execute([$institution, $degree, $major, $start_year, $end_year, $courses, $description, $id]);
            } else {
                $sql = "UPDATE education SET institution='$institution', degree='$degree', major='$major', start_year='$start_year', end_year='$end_year', courses='$courses', description='$description' WHERE id=$id";
                $conn->query($sql);
            }
            $success = "教育背景更新成功";
        } elseif (isset($_POST['delete'])) {
            // Delete education
            $id = $_POST['id'];
            
            if (isPDO($conn)) {
                $stmt = $conn->prepare("DELETE FROM education WHERE id=?");
                $stmt->execute([$id]);
            } else {
                $sql = "DELETE FROM education WHERE id=$id";
                $conn->query($sql);
            }
            $success = "教育背景删除成功";
        }
    } catch (Exception $e) {
        $error = "操作失败: " . $e->getMessage();
    }
}

// Get education list
try {
    if (isPDO($conn)) {
        $stmt = $conn->query("SELECT * FROM education ORDER BY start_year DESC");
        $education = $stmt->fetchAll();
    } else {
        $result = $conn->query("SELECT * FROM education ORDER BY start_year DESC");
        $education = [];
        while ($row = $result->fetch_assoc()) {
            $education[] = $row;
        }
    }
} catch (Exception $e) {
        $error = "获取教育背景失败: " . $e->getMessage();
        $education = [];
}

$conn = null;
?>
<div class="education-management">
    <h2>教育背景管理</h2>
    <p>添加、编辑和删除教育背景</p>
    
    <?php if ($success) { echo '<div class="alert alert-success">' . $success . '</div>'; } ?>
    <?php if ($error) { echo '<div class="alert alert-error">' . $error . '</div>'; } ?>
    
    <!-- Add education form -->
    <div class="card">
        <h3>添加教育背景</h3>
        <form method="POST" action="index.php?page=education">
            <div class="form-group">
                <label for="institution">学校/机构</label>
                <input type="text" id="institution" name="institution" placeholder="例如：桂林电子科技大学" required>
            </div>
            <div class="form-group">
                <label for="degree">学位</label>
                <input type="text" id="degree" name="degree" placeholder="例如：本科" required>
            </div>
            <div class="form-group">
                <label for="major">专业</label>
                <input type="text" id="major" name="major" placeholder="例如：数据科学与大数据" required>
            </div>
            <div class="form-group">
                <label for="start_year">开始年份</label>
                <input type="number" id="start_year" name="start_year" min="1900" max="2100" placeholder="例如：2022" required>
            </div>
            <div class="form-group">
                <label for="end_year">结束年份</label>
                <input type="number" id="end_year" name="end_year" min="1900" max="2100" placeholder="例如：2026" required>
            </div>
            <div class="form-group">
                <label for="courses">主修课程</label>
                <textarea id="courses" name="courses" placeholder="例如：数据结构、算法设计、操作系统、计算机网络、数据库原理、数据科学、大数据技术、机器学习、Python编程等" required></textarea>
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea id="description" name="description" placeholder="教育背景描述"></textarea>
            </div>
            <button type="submit" name="add" class="btn btn-primary">添加教育背景</button>
        </form>
    </div>
    
    <!-- Education list -->
    <div class="card">
        <h3>教育背景列表</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>学校/机构</th>
                    <th>学位</th>
                    <th>专业</th>
                    <th>年份</th>
                    <th>课程</th>
                    <th>描述</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($education as $edu) { ?>
                <tr>
                    <td><?php echo $edu['id']; ?></td>
                    <td><?php echo htmlspecialchars($edu['institution']); ?></td>
                    <td><?php echo htmlspecialchars($edu['degree']); ?></td>
                    <td><?php echo htmlspecialchars($edu['major']); ?></td>
                    <td><?php echo htmlspecialchars($edu['start_year']); ?> - <?php echo htmlspecialchars($edu['end_year']); ?></td>
                    <td><?php echo substr(htmlspecialchars($edu['courses']), 0, 50); ?>...</td>
                    <td><?php echo substr(htmlspecialchars($edu['description']), 0, 30); ?>...</td>
                    <td>
                        <button class="btn btn-secondary" onclick="editEducation(<?php echo $edu['id']; ?>, '<?php echo addslashes($edu['institution']); ?>', '<?php echo addslashes($edu['degree']); ?>', '<?php echo addslashes($edu['major']); ?>', '<?php echo addslashes($edu['start_year']); ?>', '<?php echo addslashes($edu['end_year']); ?>', '<?php echo addslashes($edu['courses']); ?>', '<?php echo addslashes($edu['description']); ?>')">编辑</button>
                        <form method="POST" action="index.php?page=education" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $edu['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('确定要删除这个教育背景吗？');">删除</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <!-- 编辑教育背景模态框 -->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content" id="modalContent">
            <div class="modal-header" id="modalHeader" style="cursor: move;">
                <h3>编辑教育背景</h3>
                <button type="button" class="btn-close" onclick="closeModal()" style="float: right; background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
            </div>
            <form method="POST" action="index.php?page=education" id="editForm">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editInstitution">学校/机构</label>
                    <input type="text" id="editInstitution" name="institution" required>
                </div>
                <div class="form-group">
                    <label for="editDegree">学位</label>
                    <input type="text" id="editDegree" name="degree" required>
                </div>
                <div class="form-group">
                    <label for="editMajor">专业</label>
                    <input type="text" id="editMajor" name="major" required>
                </div>
                <div class="form-group">
                    <label for="editStartYear">开始年份</label>
                    <input type="number" id="editStartYear" name="start_year" min="1900" max="2100" required>
                </div>
                <div class="form-group">
                    <label for="editEndYear">结束年份</label>
                    <input type="number" id="editEndYear" name="end_year" min="1900" max="2100" required>
                </div>
                <div class="form-group">
                    <label for="editCourses">主修课程</label>
                    <textarea id="editCourses" name="courses" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editDescription">描述</label>
                    <textarea id="editDescription" name="description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">保存更改</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">取消</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        /**
         * 教育背景编辑弹窗控制器
         * 提供拖动、打开、关闭等功能
         */
        (function() {
            'use strict';
            
            // DOM元素引用
            var modal = document.getElementById('editModal');
            var modalContent = document.getElementById('modalContent');
            var modalHeader = document.getElementById('modalHeader');
            var editForm = document.getElementById('editForm');
            
            // 拖动状态
            var isDragging = false;
            var startX = 0;
            var startY = 0;
            var offsetX = 0;
            var offsetY = 0;
            
            /**
             * 打开模态框并填充数据
             */
            window.editEducation = function(id, institution, degree, major, start_year, end_year, courses, description) {
                // 填充表单数据
                document.getElementById('editId').value = id;
                document.getElementById('editInstitution').value = institution;
                document.getElementById('editDegree').value = degree;
                document.getElementById('editMajor').value = major;
                document.getElementById('editStartYear').value = start_year;
                document.getElementById('editEndYear').value = end_year;
                document.getElementById('editCourses').value = courses;
                document.getElementById('editDescription').value = description;
                
                // 显示模态框
                modal.style.display = 'block';
                
                // 清除之前的变换
                modalContent.style.transform = '';
            };
            
            /**
             * 关闭模态框
             */
            window.closeModal = function() {
                modal.style.display = 'none';
                stopDrag();
            };
            
            /**
             * 开始拖动
             */
            function startDrag(e) {
                // 如果点击的是按钮，不启动拖动
                if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                    return;
                }
                
                isDragging = true;
                
                // 获取鼠标起始位置
                startX = e.clientX;
                startY = e.clientY;
                
                // 保存初始偏移量
                var transform = window.getComputedStyle(modalContent).transform;
                if (transform !== 'none') {
                    var matrix = new DOMMatrix(transform);
                    offsetX = matrix.e;
                    offsetY = matrix.f;
                } else {
                    offsetX = 0;
                    offsetY = 0;
                }
                
                // 添加拖动样式
                modalContent.style.cursor = 'move';
                modalContent.style.userSelect = 'none';
                
                // 绑定全局事件
                document.addEventListener('mousemove', onDrag, { passive: false });
                document.addEventListener('mouseup', stopDrag);
                
                // 阻止默认行为，防止选中文本
                e.preventDefault();
            }
            
            /**
             * 拖动中
             */
            function onDrag(e) {
                if (!isDragging) return;
                
                // 计算移动距离
                var dx = e.clientX - startX;
                var dy = e.clientY - startY;
                
                // 计算新的偏移量
                var newOffsetX = offsetX + dx;
                var newOffsetY = offsetY + dy;
                
                // 边界限制：确保弹窗不会完全移出视口
                var modalWidth = modalContent.offsetWidth;
                var modalHeight = modalContent.offsetHeight;
                var viewportWidth = window.innerWidth;
                var viewportHeight = window.innerHeight;
                
                // 计算弹窗当前位置
                var rect = modalContent.getBoundingClientRect();
                var currentLeft = rect.left;
                var currentTop = rect.top;
                
                // 限制水平位置
                var newLeft = currentLeft + dx;
                if (newLeft < -modalWidth + 100) {
                    newOffsetX = offsetX - (currentLeft - (-modalWidth + 100));
                } else if (newLeft > viewportWidth - 100) {
                    newOffsetX = offsetX - (currentLeft - (viewportWidth - 100));
                }
                
                // 限制垂直位置
                var newTop = currentTop + dy;
                if (newTop < 0) {
                    newOffsetY = offsetY - currentTop;
                } else if (newTop > viewportHeight - 100) {
                    newOffsetY = offsetY - (currentTop - (viewportHeight - 100));
                }
                
                // 应用新位置（使用transform，保持原始样式不变）
                modalContent.style.transform = 'translate(' + newOffsetX + 'px, ' + newOffsetY + 'px)';
                
                // 阻止默认行为
                e.preventDefault();
            }
            
            /**
             * 停止拖动
             */
            function stopDrag() {
                isDragging = false;
                
                if (modalContent) {
                    // 恢复原始样式
                    modalContent.style.cursor = '';
                    modalContent.style.userSelect = '';
                }
                
                // 移除全局事件
                document.removeEventListener('mousemove', onDrag);
                document.removeEventListener('mouseup', stopDrag);
            }
            
            /**
             * 点击模态框外部关闭
             */
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            /**
             * 绑定拖动事件到头部
             */
            if (modalHeader) {
                modalHeader.addEventListener('mousedown', startDrag);
            }
            
            /**
             * 表单提交处理
             */
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    // 表单会正常提交，页面会刷新
                    console.log('表单提交中...');
                });
            }
        })();
    </script>
</div>