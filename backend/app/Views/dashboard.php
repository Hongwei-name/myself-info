<?php
// 仪表盘页面
?>
<section class="dashboard" role="region" aria-labelledby="dashboard-title">
    <h2 id="dashboard-title">仪表盘</h2>
    <p>欢迎来到个人管理后台，这里是您的内容概览</p>
    
    <!-- 统计卡片 -->
    <div class="dashboard-grid" aria-label="统计数据">
        <div class="dashboard-card" role="status" aria-live="polite">
            <div class="card-icon">💼</div>
            <div class="card-value" id="experience-count">0</div>
            <div class="card-label">工作经历</div>
        </div>
        <div class="dashboard-card" role="status" aria-live="polite">
            <div class="card-icon">📁</div>
            <div class="card-value" id="projects-count">0</div>
            <div class="card-label">项目</div>
        </div>
        <div class="dashboard-card" role="status" aria-live="polite">
            <div class="card-icon">💪</div>
            <div class="card-value" id="skills-count">0</div>
            <div class="card-label">技能</div>
        </div>
        <div class="dashboard-card" role="status" aria-live="polite">
            <div class="card-icon">👥</div>
            <div class="card-value" id="clients-count">0</div>
            <div class="card-label">客户</div>
        </div>
    </div>
    
    <!-- 快速操作 -->
    <div class="card" role="complementary" aria-labelledby="quick-actions-title">
        <h3 id="quick-actions-title">快速操作</h3>
        <div class="quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
            <a href="index.php?page=personal" class="btn btn-primary" aria-label="管理个人信息">
                <span class="nav-icon">👤</span> 管理个人信息
            </a>
            <a href="index.php?page=skills" class="btn btn-primary" aria-label="管理技能">
                <span class="nav-icon">💪</span> 管理技能
            </a>
            <a href="index.php?page=projects" class="btn btn-primary" aria-label="管理项目">
                <span class="nav-icon">📁</span> 管理项目
            </a>
            <a href="index.php?page=contact" class="btn btn-primary" aria-label="管理联系信息">
                <span class="nav-icon">📞</span> 管理联系信息
            </a>
        </div>
    </div>
    
    <!-- 系统状态 -->
    <div class="card" role="complementary" aria-labelledby="system-status-title">
        <h3 id="system-status-title">系统状态</h3>
        <div class="system-status" style="margin-top: 1rem;">
            <div class="status-item" style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding: 0.5rem; background: #f8f9fa; border-radius: 8px;">
                <span>数据库连接</span>
                <span class="status-success" style="color: #00B42A;">✓ 正常</span>
            </div>
            <div class="status-item" style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding: 0.5rem; background: #f8f9fa; border-radius: 8px;">
                <span>API状态</span>
                <span class="status-success" style="color: #00B42A;">✓ 正常</span>
            </div>
            <div class="status-item" style="display: flex; justify-content: space-between; padding: 0.5rem; background: #f8f9fa; border-radius: 8px;">
                <span>前端连接</span>
                <span class="status-success" style="color: #00B42A;">✓ 正常</span>
            </div>
        </div>
    </div>
</section>

<script>
// 获取统计数据
async function fetchStats() {
    try {
        const response = await fetch('api.php/api/stats');
        if (!response.ok) throw new Error('Failed to fetch stats');
        const data = await response.json();
        
        // 更新统计数据
        document.getElementById('experience-count').textContent = data.experience || 0;
        document.getElementById('projects-count').textContent = data.projects || 0;
        document.getElementById('skills-count').textContent = data.skills || 0;
        document.getElementById('clients-count').textContent = data.clients || 0;
    } catch (error) {
        console.error('Error fetching stats:', error);
    }
}

// 页面加载时获取数据
window.onload = fetchStats;
</script>