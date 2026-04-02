<template>
  <div class="contact">
    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container">
        <h2 class="section-title">联系我</h2>
        <p class="section-description">
          如果您有任何问题或合作意向，欢迎随时联系我。
        </p>
        <div class="contact-content">
          <div class="contact-info">
            <h3 class="contact-info-title">联系信息</h3>
            <div class="contact-info-items">
              <div class="contact-info-item" v-for="(item, index) in contactItems" :key="index">
                <div class="contact-info-icon">
                  <i :class="['iconfont', item.icon]"></i>
                </div>
                <div class="contact-info-text">
                  <h4>{{ item.title }}</h4>
                  <p>{{ item.value }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import gsap from 'gsap'
import { api } from '../services/api.js'

// Reactive data from API
const contactItems = ref([
  { icon: 'icon-github', title: 'GitHub', value: '#' },
  { icon: 'icon-blog', title: 'Blog', value: '#' },
  { icon: 'icon-email-fill', title: 'Email', value: '3485581538@qq.com' },
  { icon: 'icon-wechat-fill', title: 'WeChat', value: 'chenhongwei' }
])

// Fetch data from API
const fetchData = async () => {
  const contactResult = await api.getContactInfo()
  if (contactResult.success && contactResult.data.length > 0) {
    contactItems.value = contactResult.data
  }
}

onMounted(async () => {
  // Fetch data from API
  await fetchData()

  setTimeout(() => {
    gsap.fromTo('.contact-info',
      { opacity: 0, y: 30 }, 
      { opacity: 1, y: 0, duration: 1, ease: 'power2.out' } // 强制显示
    )

    gsap.fromTo('.contact-info-item',
      { opacity: 0, y: 20 },    
      { opacity: 1, y: 0, duration: 0.8, stagger: 0.1, delay: 0.4, ease: 'power2.out' }
    )
  }, 100)
})
</script>

<style scoped>

.contact-section {
  padding: 3rem 0 8rem 0;
  background: #f9f9f9;
  position: relative;
  overflow: hidden;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  text-align: center;
  margin-bottom: 1rem;
  letter-spacing: -0.5px;
  position: relative;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: #007bff;
  border-radius: 2px;
}

.section-description {
  font-size: 1.1rem;
  color: #666;
  text-align: center;
  margin-bottom: 4rem;
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
  line-height: 1.6;
}

/* 让联系方式居中显示 */
.contact-content {
  display: flex;
  justify-content: center;
  max-width: 800px;
  margin: 0 auto;
  position: relative;
}

.contact-info {
  background: #f9f9f9;
  padding: 2.5rem;
  border-radius: 12px;
  border: 1px solid #e0e0e0;
  position: relative;
  overflow: hidden;
  width: 100%;
}

.contact-info::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
}

.contact-info-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
  text-align: center;
}

.contact-info-items {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.contact-info-item {
  display: flex;
  align-items: flex-start;
  gap: 1.5rem;
  transition: all 0.3s ease;
  padding: 1rem;
  border-radius: 8px;
  background: white;
  border: 1px solid #e0e0e0;
}

.contact-info-item:hover {
  transform: translateX(5px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  border-color: #007bff;
}

.contact-info-icon {
  font-size: 1.5rem;
  margin-top: 0.25rem;
  flex-shrink: 0;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #e8f0fe;
  border-radius: 50%;
  color: #007bff;
}

.contact-info-text h4 {
  font-size: 1rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 0.25rem;
}

.contact-info-text p {
  font-size: 1rem;
  color: #555;
  margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .contact-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
}

@media (max-width: 480px) {
  .contact-section {
    padding: 6rem 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .contact-info {
    padding: 1.5rem;
  }

  .contact-info-item {
    padding: 0.75rem;
  }

  .contact-info-icon {
    width: 32px;
    height: 32px;
    font-size: 1.25rem;
  }
}
</style>