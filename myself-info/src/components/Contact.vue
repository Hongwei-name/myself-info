<script setup>
// Contact组件 - 联系信息和表单
import { ref, onMounted } from 'vue'
import gsap from 'gsap'

const isVisible = ref(false)

onMounted(() => {
  isVisible.value = true
  
  // 使用GSAP添加炫酷动画
  gsap.timeline()
    .from('.section-header', {
      y: 50,
      opacity: 0,
      duration: 1,
      ease: 'power3.out'
    })
    .from('.contact-container', {
      y: 100,
      opacity: 0,
      duration: 1,
      ease: 'power3.out'
    }, 0.3)
})
</script>

<template>
  <div class="contact">
    <div class="container">
      <div class="section-header" :class="{ 'visible': isVisible }">
        <h2>联系我</h2>
        <div class="divider"></div>
        <p>这里将添加联系信息</p>
      </div>
      
      <div class="contact-container glass" :class="{ 'visible': isVisible }">
        <div class="contact-info">
          <h3>联系方式</h3>
          <div class="info-item">
            <span class="label">姓名：</span>
            <span class="value">陈洪伟</span>
          </div>
          <div class="info-item">
            <span class="label">电话：</span>
            <span class="value">18929749359</span>
          </div>
          <div class="info-item">
            <span class="label">邮箱：</span>
            <span class="value">3485581538@qq.com</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.contact {
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.contact::before {
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

.section-header {
  text-align: center;
  margin-bottom: 4rem;
  transform: translateY(30px);
  opacity: 0;
  transition: all 1s ease-out;
  position: relative;
  z-index: 1;
}

.section-header.visible {
  transform: translateY(0);
  opacity: 1;
}

.section-header h2 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
  animation: fadeInDown 1s ease-out;
  overflow: hidden;
}

.section-header h2::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.8s ease;
}

.section-header h2:hover::before {
  left: 100%;
}

.section-header h2::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  border-radius: 3px;
  animation: grow 1s ease-out 0.3s both;
}

@keyframes grow {
  from {
    width: 0;
  }
  to {
    width: 100px;
  }
}

.divider {
  width: 50px;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  margin: 0 auto 2rem;
  border-radius: 3px;
  animation: fadeIn 1s ease-out 0.5s both;
}

.section-header p {
  font-size: 1.1rem;
  color: #666;
  max-width: 600px;
  margin: 0 auto;
  animation: fadeIn 1s ease-out 0.7s both;
  position: relative;
  overflow: hidden;
}

.section-header p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.section-header p:hover::before {
  left: 100%;
}

.contact-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 4rem;
  border-radius: 16px;
  transition: all 0.3s ease;
  transform: translateY(50px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
  position: relative;
  z-index: 1;
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.contact-container::before {
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

.contact-container:hover::before {
  left: 100%;
}

.contact-container:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(31, 38, 135, 0.2);
}

.contact-info {
  text-align: center;
  position: relative;
  z-index: 1;
  width: 100%;
}

.contact-info h3 {
  font-size: 1.8rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
  position: relative;
  overflow: hidden;
}

.contact-info h3::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.contact-info h3:hover::before {
  left: 100%;
}

.info-item {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 1.5rem;
  font-size: 1.1rem;
  animation: fadeInUp 1s ease-out both;
}

.info-item:nth-child(2) {
  animation-delay: 0.2s;
}

.info-item:nth-child(3) {
  animation-delay: 0.4s;
}

.info-item:nth-child(4) {
  animation-delay: 0.6s;
}

.info-item .label {
  font-weight: 600;
  color: #333;
  margin-right: 1rem;
  min-width: 80px;
  text-align: right;
}

.info-item .value {
  color: #555;
  flex: 1;
  text-align: left;
  position: relative;
  overflow: hidden;
}

.info-item .value::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.info-item:hover .value::before {
  left: 100%;
}

@media (max-width: 768px) {
  .contact-container {
    margin: 0 1rem;
    padding: 2rem;
  }
}
</style>