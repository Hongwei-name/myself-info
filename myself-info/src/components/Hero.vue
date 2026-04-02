<script setup>
// Hero组件 - 网站首页的主要展示区域
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const isVisible = ref(false)

onMounted(() => {
  isVisible.value = true
})
</script>

<template>
  <div class="hero">
    <div class="container">
      <div class="hero-content glass" :class="{ 'visible': isVisible }">
        <div class="hero-text">
          <h1>你好，我是 <span class="name">陈洪伟</span></h1>
          <p class="subtitle">前端开发工程师</p>
          <p class="slogan">Code Crafts My Reality</p>
          <p class="description">
            专注于创建美观、高效的Web应用程序，
            热爱前端技术，不断学习和探索新的技术栈。
          </p>
          <div class="hero-buttons">
            <a href="/projects" class="btn primary" @click.prevent="router.push('/projects')">查看项目</a>
            <a href="/contact" class="btn secondary" @click.prevent="router.push('/contact')">联系我</a>
          </div>
        </div>
        <div class="hero-image">
          <div class="image-container">
            <img src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=professional%20portrait%20of%20a%20software%20developer%20working%20on%20code%2C%20modern%20office%20setting%2C%20soft%20lighting%2C%20professional%20attire&image_size=portrait_4_3" alt="陈洪伟" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.hero {
  min-height: auto;
  padding: 120px 0;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    radial-gradient(circle at 20% 30%, rgba(147, 197, 253, 0.15) 0%, transparent 30%),
    radial-gradient(circle at 80% 70%, rgba(167, 139, 250, 0.15) 0%, transparent 30%),
    radial-gradient(circle at 40% 80%, rgba(252, 165, 165, 0.1) 0%, transparent 25%),
    radial-gradient(circle at 70% 20%, rgba(165, 243, 252, 0.1) 0%, transparent 25%);
  z-index: 0;
}

.hero-content {
  display: flex;
  align-items: center;
  gap: 4rem;
  position: relative;
  z-index: 1;
  padding: 4rem;
  margin-top: 80px;
  transform: translateY(50px);
  opacity: 0;
  transition: all 1s ease-out;
  border-radius: 24px;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
}

.hero-content.visible {
  transform: translateY(0);
  opacity: 1;
}

.hero-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(31, 38, 135, 0.15);
  background: rgba(255, 255, 255, 0.2);
}

.hero-text {
  flex: 1;
  max-width: 500px;
  animation: fadeInLeft 1s ease-out 0.3s both;
}

.hero-text h1 {
  font-size: 3.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #333;
  line-height: 1.2;
  position: relative;
  overflow: hidden;
}

.hero-text h1::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.hero-text h1:hover::before {
  left: 100%;
}

.hero-text .name {
  color: #007bff;
  position: relative;
  animation: pulse 2s ease-in-out infinite;
}

.hero-text .name::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  border-radius: 3px;
  animation: underline 2s ease-in-out infinite;
}

@keyframes underline {
  0%, 100% {
    transform: scaleX(1);
  }
  50% {
    transform: scaleX(0.8);
  }
}

.hero-text .subtitle {
  font-size: 1.5rem;
  color: #666;
  margin-bottom: 1rem;
  font-weight: 500;
  animation: fadeInUp 1s ease-out 0.5s both;
}

.hero-text .slogan {
  font-size: 1.2rem;
  color: #007bff;
  margin-bottom: 1.5rem;
  font-weight: 600;
  font-style: italic;
  background: linear-gradient(90deg, #007bff, #0056b3);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  position: relative;
  animation: fadeInUp 1s ease-out 0.6s both, glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
  from {
    text-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
  }
  to {
    text-shadow: 0 0 20px rgba(0, 123, 255, 0.8), 0 0 30px rgba(0, 123, 255, 0.4);
  }
}

.hero-text .description {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 2.5rem;
  line-height: 1.6;
  animation: fadeInUp 1s ease-out 0.7s both;
}

.hero-buttons {
  display: flex;
  gap: 1rem;
  animation: fadeInUp 1s ease-out 0.9s both;
}

.btn {
  padding: 1rem 2rem;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
  z-index: -1;
}

.btn:hover::before {
  left: 100%;
}

.btn.primary {
  background-color: #007bff;
  color: white;
}

.btn.primary:hover {
  background-color: #0056b3;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
  animation: pulse 1s ease-in-out;
}

.btn.secondary {
  background-color: transparent;
  color: #007bff;
  border-color: #007bff;
}

.btn.secondary:hover {
  background-color: #007bff;
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
  animation: pulse 1s ease-in-out;
}

.hero-image {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  animation: fadeInRight 1s ease-out 1.1s both;
}

.image-container {
  position: relative;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  animation: float 6s ease-in-out infinite;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  padding: 10px;
}

.image-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 50%;
  background: linear-gradient(45deg, #007bff, transparent, #007bff);
  z-index: -1;
  animation: rotate 20s linear infinite;
}

@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-20px);
  }
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: all 0.3s ease;
  border-radius: 50%;
}

.image-container:hover img {
  transform: scale(1.1) rotate(5deg);
}

@media (max-width: 768px) {
  .hero-content {
    flex-direction: column;
    text-align: center;
    gap: 2rem;
    padding: 2rem;
  }
  
  .hero-text h1 {
    font-size: 2.5rem;
  }
  
  .hero-text .subtitle {
    font-size: 1.2rem;
  }
  
  .hero-buttons {
    justify-content: center;
  }
  
  .image-container {
    width: 200px;
    height: 200px;
  }
}
</style>