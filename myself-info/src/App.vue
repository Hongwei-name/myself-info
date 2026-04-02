<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import gsap from 'gsap'

const router = useRouter()
const route = useRoute()
const isMenuOpen = ref(false)
const isLoaded = ref(false)

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}

const navigateTo = (path) => {
  // 添加页面切换动画
  gsap.to('main', {
    opacity: 0,
    y: 50,
    duration: 0.5,
    ease: 'power2.inOut',
    onComplete: () => {
      router.push(path)
      gsap.set('main', { opacity: 1, y: 0 })
      isMenuOpen.value = false
    }
  })
}

onMounted(() => {
  // 页面加载动画
  gsap.set('body', { opacity: 0 })
  gsap.set('main', { opacity: 0, y: 50 })
  
  gsap.to('body', {
    opacity: 1,
    duration: 1,
    ease: 'power2.inOut'
  })
  
  gsap.to('main', {
    opacity: 1,
    y: 0,
    duration: 1,
    ease: 'power2.inOut',
    delay: 0.2,
    onComplete: () => {
      isLoaded.value = true
    }
  })
  
  // 导航栏滚动效果
  window.addEventListener('scroll', handleScroll)
})

const handleScroll = () => {
  const navbar = document.querySelector('.navbar')
  if (window.scrollY > 50) {
    gsap.to(navbar, {
      backgroundColor: 'rgba(255, 255, 255, 0.95)',
      boxShadow: '0 4px 20px rgba(0, 0, 0, 0.1)',
      duration: 0.3
    })
  } else {
    gsap.to(navbar, {
      backgroundColor: 'rgba(255, 255, 255, 0.8)',
      boxShadow: 'none',
      duration: 0.3
    })
  }
}

// 监听路由变化，添加页面切换动画
watch(
  () => route.path,
  () => {
    // 确保新页面加载后内容可见
    gsap.from('main', {
      opacity: 0,
      y: 50,
      duration: 0.8,
      ease: 'power2.inOut'
    })
  }
)
</script>

<template>
  <div class="app">
    <!-- Navigation -->
    <nav class="navbar">
      <div class="container">
        <div class="navbar-content">
          <a href="/" @click.prevent="navigateTo('/')" class="logo">
            <div class="logo-container">
              <img src="https://i.cetsteam.com/imgs/2026/04/01/f37915722ac27d20.jpg" alt="陈洪伟" class="logo-image" />
              <span class="logo-text">陈洪伟</span>
            </div>
          </a>
          <div class="nav-links">
            <a href="/" @click.prevent="navigateTo('/')" class="nav-link" :class="{ 'active': route.path === '/' }">首页</a>
            <a href="/about" @click.prevent="navigateTo('/about')" class="nav-link" :class="{ 'active': route.path === '/about' }">关于</a>
            <a href="/projects" @click.prevent="navigateTo('/projects')" class="nav-link" :class="{ 'active': route.path === '/projects' }">项目</a>
            <a href="/contact" @click.prevent="navigateTo('/contact')" class="nav-link" :class="{ 'active': route.path === '/contact' }">联系</a>
          </div>
          <button class="menu-toggle" :class="{ 'active': isMenuOpen }" @click="toggleMenu" aria-label="菜单">
            <span class="menu-icon"></span>
            <span class="menu-icon"></span>
            <span class="menu-icon"></span>
          </button>
        </div>
      </div>
      <!-- Mobile Menu -->
      <div class="mobile-menu" :class="{ 'open': isMenuOpen }">
        <div class="mobile-menu-content">
          <a href="/" @click.prevent="navigateTo('/')" class="mobile-nav-link" :class="{ 'active': route.path === '/' }">首页</a>
          <a href="/about" @click.prevent="navigateTo('/about')" class="mobile-nav-link" :class="{ 'active': route.path === '/about' }">关于</a>
          <a href="/projects" @click.prevent="navigateTo('/projects')" class="mobile-nav-link" :class="{ 'active': route.path === '/projects' }">项目</a>
          <a href="/contact" @click.prevent="navigateTo('/contact')" class="mobile-nav-link" :class="{ 'active': route.path === '/contact' }">联系</a>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="main">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-info">
            <h3 class="footer-title">陈洪伟</h3>
            <p class="footer-subtitle">Code Crafts My Reality</p>
          </div>
          <div class="footer-social">
            <a href="#" class="social-link">
              <i class="iconfont icon-github"></i>
              GitHub
            </a>
            <a href="#" class="social-link">
              <i class="iconfont icon-blog"></i>
              Blog
            </a>
            <a href="#" class="social-link">
              <i class="iconfont icon-email-fill"></i>
              Email
            </a>
            <a href="#" class="social-link">
              <i class="iconfont icon-wechat-fill"></i>
              WeChat
            </a>
          </div>
          <div class="footer-copyright">
            <p>© 2026 陈洪伟. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style>
/* Global Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
  font-size: 16px;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
  line-height: 1.6;
  color: #333;
  background: #f9f9f9;
  overflow-x: hidden;
  transition: background-color 0.3s ease;
}

/* App Container */
.app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* Container */
.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

/* Navbar */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.navbar-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 0;
}

.logo {
  text-decoration: none;
  display: flex;
  align-items: center;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.logo-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #007bff;
  transition: all 0.3s ease;
}

.logo-image:hover {
  transform: scale(1.1);
  box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
}

.logo-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  transition: color 0.3s ease;
}

.logo-text:hover {
  color: #007bff;
}

.nav-links {
  display: flex;
  gap: 2.5rem;
}

.nav-link {
  text-decoration: none;
  color: #555;
  font-weight: 500;
  font-size: 1rem;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 0;
  overflow: hidden;
}

.nav-link::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #007bff, transparent);
  transition: left 0.5s ease;
}

.nav-link:hover {
  color: #007bff;
}

.nav-link:hover::before {
  left: 100%;
}

/* Menu Toggle */
.menu-toggle {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.5rem;
  z-index: 1001;
  flex-direction: column;
  gap: 0.5rem;
}

.menu-icon {
  display: block;
  width: 24px;
  height: 2px;
  background: #333;
  transition: all 0.3s ease;
  position: relative;
}

.menu-toggle.active .menu-icon:nth-child(1) {
  transform: rotate(45deg);
  top: 7px;
}

.menu-toggle.active .menu-icon:nth-child(2) {
  opacity: 0;
}

.menu-toggle.active .menu-icon:nth-child(3) {
  transform: rotate(-45deg);
  top: -7px;
}

/* Mobile Menu */
.mobile-menu {
  position: fixed;
  top: 0;
  right: -100%;
  width: 80%;
  height: 100vh;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
  transition: right 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  z-index: 999;
  display: flex;
  align-items: center;
  justify-content: center;
}

.mobile-menu.open {
  right: 0;
}

.mobile-menu-content {
  display: flex;
  flex-direction: column;
  gap: 3rem;
  padding: 2rem;
  text-align: center;
}

.mobile-nav-link {
  text-decoration: none;
  color: #333;
  font-size: 1.5rem;
  font-weight: 600;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 0;
}

.mobile-nav-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: #007bff;
  transition: width 0.3s ease;
}

.mobile-nav-link:hover {
  color: #007bff;
}

.mobile-nav-link:hover::after {
  width: 100%;
}

/* Main Content */
.main {
  flex: 1;
  margin-top: 100px;
  position: relative;
  overflow: hidden;
}

/* Footer */
.footer {
  background: #f5f5f5;
  padding: 4rem 0;
  margin-top: 4rem;
  position: relative;
  overflow: hidden;
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 100%;
  background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 123, 255, 0.1) 100%);
  z-index: 1;
}

.footer-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
  position: relative;
  z-index: 2;
}

.footer-info {
  text-align: center;
}

.footer-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 0.5rem;
}

.footer-subtitle {
  color: #666;
  margin: 0;
}

.footer-social {
  display: flex;
  gap: 2rem;
}

.social-link {
  text-decoration: none;
  color: #666;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.social-icon {
  transition: all 0.3s ease;
  font-size: 18px;
  margin-right: 5px;
}

.social-link:hover .social-icon {
  transform: scale(1.2);
  color: #007bff;
}

.social-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #007bff;
  transition: width 0.3s ease;
}

.social-link:hover {
  color: #007bff;
}

.social-link:hover::after {
  width: 100%;
}

.footer-copyright {
  margin-top: 2rem;
  padding-top: 2rem;
  border-top: 1px solid #e0e0e0;
  width: 100%;
  text-align: center;
}

.footer-copyright p {
  color: #888;
  font-size: 0.875rem;
  margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
  .nav-links {
    display: none;
  }

  .menu-toggle {
    display: flex;
  }

  .container {
    padding: 0 1rem;
  }

  .navbar-content {
    padding: 1rem 0;
  }

  .footer {
    padding: 3rem 0;
  }

  .footer-social {
    flex-wrap: wrap;
    justify-content: center;
  }

  .main {
    margin-top: 80px;
  }
}

@media (max-width: 480px) {
  .mobile-menu {
    width: 90%;
  }

  .mobile-menu-content {
    gap: 2rem;
  }

  .mobile-nav-link {
    font-size: 1.25rem;
  }

  .footer-title {
    font-size: 1.25rem;
  }

  .logo-text {
    font-size: 1.25rem;
  }

  .logo-image {
    width: 40px;
    height: 40px;
  }
}
</style>