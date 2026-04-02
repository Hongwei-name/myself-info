<template>
  <div class="about">
    <!-- About Section -->
    <section class="about-section">
      <div class="container">
        <h2 class="section-title">关于我</h2>
        <div class="about-content">
          <div class="about-text">
            <h3 class="about-title">个人简介</h3>
            <p class="about-description">
              我是一名前端开发工程师，拥有多年的Web开发经验。我热爱前端技术，不断学习和探索新的技术栈，致力于创建美观、高效的Web应用程序。
            </p>
            <p class="about-description">
              我擅长使用Vue.js、React等现代前端框架，熟悉JavaScript、TypeScript等编程语言，以及HTML、CSS等前端基础技术。我注重代码质量和用户体验，追求极致的前端开发。
            </p>
            <p class="about-description">
              除了前端开发，我也对后端技术有一定的了解，能够使用Node.js、Express等技术构建完整的Web应用。
            </p>
            <div class="about-details">
              <div class="detail-item">
                <span class="detail-label">姓名:</span>
                <span class="detail-value">{{ personalInfo.name }}</span>
              </div>

              <div class="detail-item">
                <span class="detail-label">电话:</span>
                <span class="detail-value">{{ personalInfo.phone }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">邮箱:</span>
                <span class="detail-value">{{ personalInfo.email }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">学校:</span>
                <span class="detail-value">{{ personalInfo.university }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">专业:</span>
                <span class="detail-value">{{ personalInfo.major }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-label">证书:</span>
                <span class="detail-value">{{ personalInfo.english_cert }}、{{ personalInfo.web_cert }}</span>
              </div>
            </div>
          </div>
          <div class="about-image">
            <div class="image-container">
              <img :src="personalInfo.avatar" :alt="personalInfo.name" />
              <div class="image-glow"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Education Section -->
    <section class="education-section">
      <div class="container">
        <h2 class="section-title">教育背景</h2>
        <div class="education-timeline">
          <div class="timeline-item">
            <div class="timeline-content">
              <h3 class="timeline-title">{{ personalInfo.major }}</h3>
              <p class="timeline-subtitle">{{ personalInfo.university }} | 2022 - 2026</p>
              <p class="timeline-description">
                主修课程：{{ personalInfo.education_courses }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Work Experience Section -->
    <section class="work-section">
      <div class="container">
        <h2 class="section-title">工作经历</h2>
        <div class="work-timeline">
          <div class="timeline-item" v-for="(exp, index) in experiences" :key="index">
            <div class="timeline-content">
              <h3 class="timeline-title">{{ exp.title }}</h3>
              <p class="timeline-subtitle">{{ exp.company }} | {{ exp.date }}</p>
              <p class="timeline-description">
                {{ exp.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Skills Section -->
    <section class="skills-section">
      <div class="container">
        <h2 class="section-title">技术技能</h2>
        <div class="skills-container">
          <div class="skill-category" v-for="(category, catIndex) in skillCategories" :key="catIndex">
            <h3 class="category-title">{{ category.title }}</h3>
            <div class="skill-bars">
              <div class="skill-bar" v-for="(skill, skillIndex) in category.skills" :key="skillIndex">
                <div class="skill-info">
                  <span class="skill-name">{{ skill.name }}</span>
                  <span class="skill-level">{{ skill.level }}%</span>
                </div>
                <div class="skill-progress">
                  <div class="skill-fill" :style="{ width: skill.level + '%' }"></div>
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
import ScrollTrigger from 'gsap/ScrollTrigger'
import { api } from '../services/api.js'

// 注册ScrollTrigger插件
gsap.registerPlugin(ScrollTrigger)

// Reactive data from API
const personalInfo = ref({
  name: '陈洪伟',
  phone: '18929749359',
  email: '3485581538@qq.com',
  university: '桂林电子科技大学',
  major: '数据科学与大数据',
  english_cert: '英语四级',
  web_cert: '初级Web工程师',
  avatar: 'https://i.cetsteam.com/imgs/2026/04/01/f37915722ac27d20.jpg',
  education_courses: '数据结构、算法设计、操作系统、计算机网络、数据库原理、数据科学、大数据技术、机器学习、Python编程等'
})

const experiences = ref([
  {
    date: '2023 - 至今',
    title: '前端开发工程师',
    company: 'ABC科技有限公司',
    description: '负责公司产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。参与产品需求分析、技术方案设计、代码实现和测试等工作。'
  },
  {
    date: '2022 - 2023',
    title: '前端实习生',
    company: 'XYZ互联网公司',
    description: '参与公司项目的前端开发，使用React和JavaScript构建Web应用。学习并掌握了现代前端开发工具和技术栈。'
  }
])

// Dynamic skill categories
const skillCategories = ref([])

// Categorize skills based on backend-provided categories
const categorizeSkills = (skills) => {
  // Group skills by category
  const categoryMap = {}
  
  skills.forEach(skill => {
    const categoryName = skill.category || '其他'
    if (!categoryMap[categoryName]) {
      categoryMap[categoryName] = []
    }
    categoryMap[categoryName].push(skill)
  })
  
  // Convert to array format
  return Object.entries(categoryMap).map(([title, skills]) => ({
    id: title.toLowerCase().replace(/\s+/g, '-'),
    title,
    skills
  }))
}

// Fetch data from API
const fetchData = async () => {
  // Fetch personal info
  const personalResult = await api.getPersonalInfo()
  if (personalResult.success) {
    personalInfo.value = { ...personalInfo.value, ...personalResult.data }
  }

  // Fetch experiences
  const experiencesResult = await api.getExperiences()
  if (experiencesResult.success && experiencesResult.data.length > 0) {
    experiences.value = experiencesResult.data
  }

  // Fetch skills and categorize them
  const skillsResult = await api.getSkills()
  if (skillsResult.success && skillsResult.data.length > 0) {
    // Use backend-provided categories
    skillCategories.value = categorizeSkills(skillsResult.data)
  }
}

onMounted(async () => {
  // Fetch data from API
  await fetchData()

  // About Section Animation
  gsap.from('.about-text', {
    opacity: 0,
    x: -50,
    duration: 1,
    ease: 'power2.out'
  })
  
  gsap.from('.about-image', {
    opacity: 0,
    x: 50,
    duration: 1,
    delay: 0.3,
    ease: 'power2.out'
  })
  
  gsap.from('.detail-item', {
    opacity: 0,
    y: 20,
    duration: 0.8,
    stagger: 0.1,
    delay: 0.6,
    ease: 'power2.out'
  })
  
  // Education Section Animation
  gsap.from('.education-timeline .timeline-item', {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.3,
    scrollTrigger: {
      trigger: '.education-section',
      start: 'top 80%'
    },
    ease: 'power2.out'
  })
  
  // Work Experience Section Animation
  gsap.from('.work-timeline .timeline-item', {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.3,
    scrollTrigger: {
      trigger: '.work-section',
      start: 'top 80%'
    },
    ease: 'power2.out'
  })
  
  // Skills Section Animation
  gsap.from('.skill-category', {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.3,
    scrollTrigger: {
      trigger: '.skills-section',
      start: 'top 80%'
    },
    ease: 'power2.out'
  })
  
  // Animate skill bars
  gsap.to('.skill-fill', {
    width: (index, target) => {
      return target.style.width
    },
    duration: 1.5,
    delay: 0.5,
    scrollTrigger: {
      trigger: '.skills-section',
      start: 'top 70%'
    },
    ease: 'power2.out'
  })
})
</script>

<style scoped>
/* About Section */
.about-section {
  padding: 3rem 0;
  background: #f9f9f9;
  position: relative;
  overflow: hidden;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #333;
  text-align: center;
  margin-bottom: 4rem;
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

.about-content {
  display: flex;
  gap: 6rem;
  align-items: center;
  position: relative;
}

.about-text {
  flex: 1;
  max-width: 600px;
  position: relative;
  z-index: 1;
}

.about-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
  position: relative;
  padding-left: 1rem;
  border-left: 4px solid #007bff;
}

.about-description {
  font-size: 1.1rem;
  color: #555;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.about-details {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
  margin-top: 3rem;
  padding: 2rem;
  background: #f9f9f9;
  border-radius: 12px;
  border: 1px solid #e0e0e0;
}

.detail-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.detail-label {
  font-size: 0.9rem;
  color: #666;
  font-weight: 500;
}

.detail-value {
  font-size: 1rem;
  color: #333;
  font-weight: 600;
}

.about-image {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.image-container {
  width: 350px;
  height: 450px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  position: relative;
  transition: transform 0.3s ease;
}

.image-container:hover {
  transform: scale(1.05);
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-glow {
  position: absolute;
  top: -10px;
  left: -10px;
  right: -10px;
  bottom: -10px;
  border-radius: 16px;
  background: linear-gradient(45deg, #007bff, #0056b3);
  opacity: 0.6;
  z-index: -1;
  animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
  from {
    filter: blur(20px);
  }
  to {
    filter: blur(30px);
  }
}

/* Education Section */
.education-section {
  padding: 8rem 0;
  background: #f9f9f9;
  position: relative;
}

.education-timeline {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  padding-left: 2rem;
}

.education-timeline::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 4px;
  background: linear-gradient(180deg, #007bff, #0056b3);
  border-radius: 2px;
}

.timeline-item {
  position: relative;
  margin-bottom: 3rem;
  padding-left: 3rem;
}

.timeline-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: -12px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: white;
  border: 4px solid #007bff;
  z-index: 1;
  box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
}

.timeline-content {
  background: white;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  border: 1px solid #e0e0e0;
  position: relative;
  overflow: hidden;
}

.timeline-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.timeline-content:hover::before {
  transform: scaleX(1);
}

.timeline-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border-color: #007bff;
}

.timeline-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 0.5rem;
}

.timeline-subtitle {
  font-size: 1rem;
  color: #666;
  margin-bottom: 1rem;
  font-weight: 500;
}

.timeline-description {
  font-size: 1rem;
  color: #555;
  line-height: 1.6;
  margin: 0;
}

/* Work Experience Section */
.work-section {
  padding: 8rem 0;
  background: #f9f9f9;
  position: relative;
}

.work-timeline {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  padding-left: 2rem;
}

.work-timeline::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 4px;
  background: linear-gradient(180deg, #007bff, #0056b3);
  border-radius: 2px;
}

/* Skills Section */
.skills-section {
  padding: 8rem 0;
  background: #f9f9f9;
  position: relative;
}

.skills-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 3rem;
  max-width: 800px;
  margin: 0 auto;
}

.skill-category {
  background: white;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  border: 1px solid #e0e0e0;
  position: relative;
  overflow: hidden;
}

.skill-category::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
}

.category-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
}

.skill-bar {
  margin-bottom: 1.5rem;
  position: relative;
}

.skill-info {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}

.skill-name {
  font-size: 0.9rem;
  font-weight: 500;
  color: #333;
}

.skill-level {
  font-size: 0.9rem;
  color: #666;
}

.skill-progress {
  width: 100%;
  height: 8px;
  background: #f0f0f0;
  border-radius: 4px;
  overflow: hidden;
  position: relative;
}

.skill-fill {
  height: 100%;
  background: linear-gradient(90deg, #007bff, #0056b3);
  border-radius: 4px;
  position: relative;
  overflow: hidden;
}

.skill-fill::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  animation: shimmer 2s infinite;
}

@keyframes shimmer {
  0% {
    left: -100%;
  }
  100% {
    left: 100%;
  }
}

/* Responsive Design */
@media (max-width: 768px) {
  .about-content {
    flex-direction: column;
    text-align: center;
    gap: 3rem;
  }

  .about-details {
    grid-template-columns: 1fr;
  }

  .education-timeline,
  .work-timeline {
    padding-left: 1.5rem;
  }

  .timeline-item {
    padding-left: 2.5rem;
  }

  .skills-container {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .about-section,
  .education-section,
  .work-section,
  .skills-section {
    padding: 6rem 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .image-container {
    width: 250px;
    height: 350px;
  }

  .timeline-content {
    padding: 1.5rem;
  }

  .skill-category {
    padding: 1.5rem;
  }

  .about-details {
    padding: 1.5rem;
  }
}
</style>