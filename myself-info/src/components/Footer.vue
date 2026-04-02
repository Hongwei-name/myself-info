<script setup>
// Footer组件 - 网站页脚
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const isVisible = ref(false)
const router = useRouter()

onMounted(() => {
  isVisible.value = true
})

const navigateTo = (path) => {
  router.push(path)
}
</script>

<template>
  <div class="footer">
    <div class="container">
      <div class="footer-content glass" :class="{ 'visible': isVisible }">
        <div class="footer-info" style="animation-delay: 0.2s;">
          <h3>陈洪伟</h3>
          <p>Code Crafts My Reality</p>
          <p>专注于创建美观、高效的Web应用程序</p>
        </div>
        <div class="footer-links" style="animation-delay: 0.4s;">
          <h4>快速链接</h4>
          <ul>
            <li><a href="/" @click.prevent="navigateTo('/')">首页</a></li>
            <li><a href="/about" @click.prevent="navigateTo('/about')">关于我</a></li>
            <li><a href="/projects" @click.prevent="navigateTo('/projects')">项目</a></li>
            <li><a href="/contact" @click.prevent="navigateTo('/contact')">联系我</a></li>
          </ul>
        </div>
        <div class="footer-contact" style="animation-delay: 0.6s;">
          <h4>联系我</h4>
          <p>📧 3485581538@qq.com</p>
          <p>📍 北京市朝阳区</p>
        </div>
      </div>
      <div class="footer-bottom" :class="{ 'visible': isVisible }" style="animation-delay: 0.8s;">
        <p>&copy; {{ new Date().getFullYear() }} 陈洪伟. 保留所有权利.</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.footer {
  padding: 3rem 0 1rem;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="%23ffffff" fill-opacity="0.1" d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z"></path></svg>') repeat;
  opacity: 0.5;
  z-index: 0;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  margin-bottom: 2rem;
  padding: 2rem;
  border-radius: 16px;
  transition: all 0.3s ease;
  transform: translateY(50px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
  position: relative;
  overflow: hidden;
}

.footer-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
  z-index: 0;
}

.footer-content:hover::before {
  left: 100%;
}

.footer-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(31, 38, 135, 0.2);
}

.footer-info {
  flex: 1;
  position: relative;
  z-index: 1;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
}

.footer-info h3 {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #007bff;
  position: relative;
  overflow: hidden;
}

.footer-info h3::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.footer-info h3:hover::before {
  left: 100%;
}

.footer-info p {
  margin-bottom: 0.5rem;
  color: #555;
  line-height: 1.5;
  position: relative;
  overflow: hidden;
}

.footer-info p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.footer-info p:hover::before {
  left: 100%;
}

.footer-links {
  flex: 1;
  position: relative;
  z-index: 1;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
}

.footer-links h4 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: #007bff;
  position: relative;
  overflow: hidden;
}

.footer-links h4::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.footer-links h4:hover::before {
  left: 100%;
}

.footer-links ul {
  list-style: none;
  padding: 0;
}

.footer-links ul li {
  margin-bottom: 0.5rem;
  position: relative;
  overflow: hidden;
}

.footer-links ul li a {
  color: #555;
  text-decoration: none;
  transition: all 0.3s ease;
  display: inline-block;
  position: relative;
  overflow: hidden;
}

.footer-links ul li a::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.footer-links ul li a:hover::before {
  left: 100%;
}

.footer-links ul li a:hover {
  color: #007bff;
  transform: translateX(5px);
  animation: pulse 1s ease-in-out;
}

.footer-contact {
  flex: 1;
  position: relative;
  z-index: 1;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
}

.footer-contact h4 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: #007bff;
  position: relative;
  overflow: hidden;
}

.footer-contact h4::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.footer-contact h4:hover::before {
  left: 100%;
}

.footer-contact p {
  margin-bottom: 0.5rem;
  color: #555;
  line-height: 1.5;
  position: relative;
  overflow: hidden;
}

.footer-contact p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.footer-contact p:hover::before {
  left: 100%;
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.2);
  padding-top: 1rem;
  text-align: center;
  color: #555;
  transform: translateY(20px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
  position: relative;
  z-index: 1;
}

.footer-bottom p {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.footer-bottom p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.8s ease;
}

.footer-bottom p:hover::before {
  left: 100%;
}

@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    gap: 2rem;
    padding: 1.5rem;
  }
  
  .footer-info,
  .footer-links,
  .footer-contact {
    transform: translateY(0);
    opacity: 1;
    animation: none;
  }
}
</style>