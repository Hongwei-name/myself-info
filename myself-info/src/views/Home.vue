<template>
  <div class="home">
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-bg"></div>
      <div class="container">
        <div class="hero-content">
          <div class="hero-text">
            <h1 class="hero-title">
              <span class="hero-title-word">你好，</span>
              <span class="hero-title-word">我是</span>
              <span class="hero-title-highlight">{{ personalInfo.name }}</span>
            </h1>
            <p class="hero-subtitle">{{ personalInfo.slogan }}</p>
            <p class="hero-description">
              {{ personalInfo.description }}
            </p>
            <div class="hero-buttons">
              <a href="/projects" @click.prevent="navigateTo('/projects')" class="btn primary">查看项目</a>
              <a href="/contact" @click.prevent="navigateTo('/contact')" class="btn secondary">联系我</a>
            </div>
          </div>
          <div class="hero-image">
            <div class="image-container">
              <img :src="personalInfo.avatar" :alt="personalInfo.name" />
              <div class="image-glow"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-shape"></div>
    </section>

    <!-- Skills Section -->
    <section class="skills">
      <div class="container">
        <h2 class="section-title">专业技能</h2>
        <div class="skills-container">
          <div class="skills-wrapper">
            <div class="skills-row">
              <div class="skill-capsule" v-for="(skill, index) in skillsRow1" :key="'row1-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
              <div class="skill-capsule" v-for="(skill, index) in skillsRow1" :key="'row1-copy-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
            </div>
            <div class="skills-row">
              <div class="skill-capsule" v-for="(skill, index) in skillsRow2" :key="'row2-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
              <div class="skill-capsule" v-for="(skill, index) in skillsRow2" :key="'row2-copy-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
            </div>
            <div class="skills-row">
              <div class="skill-capsule" v-for="(skill, index) in skillsRow3" :key="'row3-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
              <div class="skill-capsule" v-for="(skill, index) in skillsRow3" :key="'row3-copy-' + index">
                <span class="skill-name">{{ skill }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Preview -->
    <section class="projects-preview">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">精选项目</h2>
          <a href="/projects" @click.prevent="navigateTo('/projects')" class="view-all">查看全部</a>
        </div>
        <div class="projects-grid">
          <div class="project-card" v-for="(project, index) in projects" :key="index" @mouseenter="handleProjectCardHover(index, true)" @mouseleave="handleProjectCardHover(index, false)">
            <div class="project-card-inner" :ref="el => projectCardRefs[index] = el">
              <div class="project-card-front">
                <div class="project-image">
                  <img src="https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20web%20project%20interface%2C%20clean%20design%2C%20professional%20layout&image_size=landscape_16_9" :alt="project.title" />
                  <div class="project-image-overlay">
                    <div class="project-overlay-content">
                      <h3 class="project-title">{{ project.title }}</h3>
                      <div class="project-tech">
                        <span v-for="(tech, techIndex) in project.tech" :key="techIndex" class="tech-tag">{{ tech }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="project-card-back">
                <h3 class="project-title">{{ project.title }}</h3>
                <p class="project-description">{{ project.description }}</p>
                <div class="project-links">
                  <a href="#" class="project-link">查看详情</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
      <div class="container">
        <div class="stats-grid">
          <div class="stat-item">
            <div class="stat-number">{{ stats.experience }}</div>
            <div class="stat-label">年开发经验</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">{{ stats.projects }}</div>
            <div class="stat-label">完成项目</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">{{ stats.skills }}</div>
            <div class="stat-label">掌握技能</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">{{ stats.clients }}</div>
            <div class="stat-label">合作客户</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import { api } from '../services/api.js'

// 注册ScrollTrigger插件
gsap.registerPlugin(ScrollTrigger)

const router = useRouter()
const projectCardRefs = ref([])

// Reactive data from API
const personalInfo = ref({
  name: '陈洪伟',
  title: '前端开发工程师',
  slogan: 'Code Crafts My Reality',
  description: '专注于创建美观、高效的Web应用程序，热爱前端技术，不断学习和探索新的技术栈。',
  avatar: 'https://i.cetsteam.com/imgs/2026/04/01/f37915722ac27d20.jpg'
})

const skills = ref([
  'Vue.js', 'React', 'JavaScript', 'TypeScript', 'HTML', 'CSS',
  'Webpack', 'Vite', 'Git', 'npm', 'Yarn', 'ES6+',
  'Responsive Design', 'UI/UX', 'Performance Optimization', 'Code Splitting'
])

const projects = ref([
  {
    title: "电商网站",
    description: "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。",
    tech: ["Vue 3", "TypeScript", "Vuex"]
  },
  {
    title: "个人博客",
    description: "基于React和Next.js开发的个人博客系统，支持Markdown编辑和主题切换。",
    tech: ["React", "Next.js", "Markdown"]
  },
  {
    title: "管理系统",
    description: "使用Vue 3和Element Plus构建的后台管理系统，包含用户管理、权限控制等功能。",
    tech: ["Vue 3", "Element Plus", "Vuex"]
  }
])

const stats = ref({
  experience: 3,
  projects: 20,
  skills: 15,
  clients: 10
})

// 生成随机排列的技能数组
const shuffleArray = (array) => {
  const newArray = [...array]
  for (let i = newArray.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1))
    ;[newArray[i], newArray[j]] = [newArray[j], newArray[i]]
  }
  return newArray
}

// 生成三行随机排列的技能
const skillsRow1 = ref(shuffleArray(skills.value))
const skillsRow2 = ref(shuffleArray(skills.value))
const skillsRow3 = ref(shuffleArray(skills.value))

// Fetch data from API
const fetchData = async () => {
  // Fetch personal info
  const personalResult = await api.getPersonalInfo()
  if (personalResult.success) {
    personalInfo.value = personalResult.data
  }

  // Fetch skills
  const skillsResult = await api.getSkills()
  if (skillsResult.success && skillsResult.data.length > 0) {
    const skillNames = skillsResult.data.map(s => s.name)
    skills.value = skillNames.length >= 6 ? skillNames : [...skillNames, ...skills.value].slice(0, 16)
    skillsRow1.value = shuffleArray(skills.value)
    skillsRow2.value = shuffleArray(skills.value)
    skillsRow3.value = shuffleArray(skills.value)
  }

  // Fetch projects
  const projectsResult = await api.getProjects()
  if (projectsResult.success && projectsResult.data.length > 0) {
    projects.value = projectsResult.data.slice(0, 3)
  }

  // Fetch stats
  const statsResult = await api.getStats()
  if (statsResult.success) {
    stats.value = statsResult.data
  } else {
    // Update stats based on data
    stats.value.skills = skills.value.length
    stats.value.projects = projectsResult.success ? projectsResult.data.length : 20
  }
}

const navigateTo = (path) => {
  gsap.to('main', {
    opacity: 0,
    y: 50,
    duration: 0.5,
    ease: 'power2.inOut',
    onComplete: () => {
      router.push(path)
    }
  })
}

const handleProjectCardHover = (index, isHovering) => {
  if (projectCardRefs.value[index]) {
    gsap.to(projectCardRefs.value[index], {
      rotateY: isHovering ? 180 : 0,
      duration: 0.6,
      ease: 'power2.inOut'
    })
  }
}

onMounted(async () => {
  // Fetch data from API
  await fetchData()

  // Hero Section Animation
  gsap.from('.hero-title-word', {
    opacity: 0,
    y: 50,
    duration: 1,
    stagger: 0.2,
    ease: 'power2.out'
  })
  
  gsap.from('.hero-subtitle', {
    opacity: 0,
    y: 30,
    duration: 1,
    delay: 0.6,
    ease: 'power2.out'
  })
  
  gsap.from('.hero-description', {
    opacity: 0,
    y: 30,
    duration: 1,
    delay: 0.8,
    ease: 'power2.out'
  })
  
  gsap.from('.hero-buttons', {
    opacity: 0,
    y: 30,
    duration: 1,
    delay: 1,
    ease: 'power2.out'
  })
  
  gsap.from('.hero-image', {
    opacity: 0,
    scale: 0.8,
    duration: 1.2,
    delay: 0.4,
    ease: 'power2.out'
  })
  
  // Skills Section Animation
  // gsap.from('.skill-item', {
  //   opacity: 0,
  //   y: 50,
  //   duration: 0.8,
  //   stagger: 0.2,
  //   scrollTrigger: {
  //     trigger: '.skills',
  //     start: 'top 80%'
  //   },
  //   ease: 'power2.out'
  // })
  
  // Projects Preview Animation
  gsap.from('.project-card', {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.2,
    scrollTrigger: {
      trigger: '.projects-preview',
      start: 'top 80%'
    },
    ease: 'power2.out'
  })
  
  // Stats Section Animation
  // gsap.from('.stat-item', {
  //   opacity: 0,
  //   y: 30,
  //   duration: 0.8,
  //   stagger: 0.1,
  //   scrollTrigger: {
  //     trigger: '.stats',
  //     start: 'top 80%'
  //   },
  //   ease: 'power2.out'
  // })
  
  // Animate stat numbers
  const statNumbers = document.querySelectorAll('.stat-number')
  statNumbers.forEach((element, index) => {
    const target = stats[Object.keys(stats)[index]]
    gsap.from(element, {
      innerText: 0,
      duration: 2,
      snap: {
        innerText: 1
      },
      scrollTrigger: {
        trigger: '.stats',
        start: 'top 70%'
      },
      ease: 'power2.out',
      onUpdate: function() {
        element.textContent = Math.round(this.targets()[0].innerText)
      }
    })
  })
  

})
</script>

<style scoped>
/* Hero Section */
.hero {
  padding: 8rem 0;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
  color: white;
  z-index: 1;
}

.hero-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB4PSIwIiB5PSIwIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSgxNSkiPjxjaXJjbGUgY3g9IjIwIiBjeT0iMjAiIHI9IjEiIGZpbGw9IiNmZmYiIG9wYWNpdHk9IjAuMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
  opacity: 0.3;
  z-index: 1;
}

.hero-content {
  display: flex;
  align-items: center;
  gap: 6rem;
  position: relative;
  z-index: 2;
}

.hero-text {
  flex: 1;
  max-width: 600px;
}

.hero-title {
  font-size: 4rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  position: relative;
}

.hero-title-word {
  display: block;
}

.hero-title-highlight {
  color: #ffd700;
  text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
}

.hero-subtitle {
  font-size: 1.5rem;
  margin-bottom: 2rem;
  font-weight: 500;
  opacity: 0.9;
  color: #333;
}

.hero-description {
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 3rem;
  opacity: 0.9;
  color: #333;
}

.hero-buttons {
  display: flex;
  gap: 1.5rem;
}

.btn {
  display: inline-block;
  padding: 1rem 2rem;
  border-radius: 8px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
  border: none;
  font-size: 1rem;
  position: relative;
  overflow: hidden;
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
}

.btn:hover::before {
  left: 100%;
}

.btn.primary {
  background: white;
  color: #007bff;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
}

.btn.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(255, 255, 255, 0.4);
}

.btn.secondary {
  background: transparent;
  color: white;
  border: 2px solid white;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
}

.btn.secondary:hover {
  background: white;
  color: #007bff;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(255, 255, 255, 0.4);
}

.hero-image {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.image-container {
  width: 350px;
  height: 350px;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
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
  border-radius: 50%;
  background: linear-gradient(45deg, #ffd700, #007bff);
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

.hero-shape {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100px;
  background: white;
  clip-path: polygon(0 100%, 100% 100%, 100% 0);
  z-index: -1;
}

/* Skills Section */
.skills {
  padding: 8rem 0;
  background: white;
  position: relative;
  z-index: 2;
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

.skills-container {
  width: 100%;
  overflow: hidden;
  position: relative;
  padding: 1rem;
  height: 240px;
}

.skills-container::before,
.skills-container::after {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  width: 100px;
  z-index: 1;
  pointer-events: none;
}

.skills-container::before {
  left: 0;
  background: linear-gradient(to right, white, transparent);
}

.skills-container::after {
  right: 0;
  background: linear-gradient(to left, white, transparent);
}

@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.skills-wrapper {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  width: 200%;
  will-change: transform;
}

.skills-wrapper:hover .skills-row {
  animation-play-state: paused;
}

.skills-row {
  display: flex;
  gap: 1rem;
  flex-wrap: nowrap;
}

.skill-capsule {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border-radius: 50px;
  border: 1px solid rgba(0, 123, 255, 0.2);
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  white-space: nowrap;
  flex-shrink: 0;
}

.skills-row:nth-child(1) {
  animation: scroll-left 30s linear infinite;
}

.skills-row:nth-child(2) {
  animation: scroll-left 32s linear infinite;
  animation-delay: 1s;
}

.skills-row:nth-child(3) {
  animation: scroll-left 28s linear infinite;
  animation-delay: 2s;
}

.skill-capsule::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.5s ease;
}

.skill-capsule:hover::before {
  left: 100%;
}

.skill-capsule:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 18px rgba(0, 123, 255, 0.2);
  border-color: rgba(0, 123, 255, 0.4);
  background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.skill-name {
  font-size: 1rem;
  font-weight: 500;
  color: #333;
  transition: all 0.3s ease;
}

.skill-capsule:hover .skill-name {
  color: #007bff;
}

@media (max-width: 768px) {
  .skills-wrapper {
    gap: 0.75rem;
  }
  
  .skill-capsule {
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
  }
}

/* Projects Preview */
.projects-preview {
  padding: 8rem 0;
  background: #f9f9f9;
  position: relative;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 4rem;
}

.view-all {
  text-decoration: none;
  color: #007bff;
  font-weight: 500;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 0;
}

.view-all::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #007bff;
  transition: width 0.3s ease;
}

.view-all:hover::after {
  width: 100%;
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 3rem;
}

.project-card {
  perspective: 1000px;
  height: 400px;
  cursor: pointer;
}

.project-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  border: 1px solid #e0e0e0;
}

.project-card-front,
.project-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 12px;
  overflow: hidden;
}

.project-card-front {
  background: #f9f9f9;
}

.project-card-back {
  background: white;
  transform: rotateY(180deg);
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow: hidden;
}

.project-card-back::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
}

.project-image {
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
}

.project-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.project-card:hover .project-image img {
  transform: scale(1.1);
}

.project-image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.8));
  display: flex;
  align-items: flex-end;
  padding: 2rem;
  color: white;
  transition: all 0.3s ease;
}

.project-card:hover .project-image-overlay {
  background: linear-gradient(to bottom, rgba(0, 123, 255, 0.3), rgba(0, 123, 255, 0.9));
}

.project-overlay-content {
  width: 100%;
  text-align: left;
}

.project-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 1rem;
}

.project-card-back .project-title {
  color: #333;
}

.project-description {
  font-size: 1rem;
  color: #555;
  line-height: 1.6;
  margin-bottom: 2rem;
  flex: 1;
  text-align: left;
}

.project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: 1rem;
}

.tech-tag {
  font-size: 0.8rem;
  color: white;
  background: rgba(255, 255, 255, 0.2);
  padding: 0.375rem 0.75rem;
  border-radius: 16px;
  transition: all 0.3s ease;
}

.project-card-back .tech-tag {
  color: #666;
  background: #f0f0f0;
}

.tech-tag:hover {
  background: rgba(255, 255, 255, 0.3);
}

.project-card-back .tech-tag:hover {
  background: #e8f0fe;
  color: #007bff;
}

.project-links {
  display: flex;
  gap: 1rem;
  margin-top: auto;
}

.project-link {
  text-decoration: none;
  color: #007bff;
  font-size: 0.9rem;
  font-weight: 500;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 1rem;
  border: 1px solid #007bff;
  border-radius: 8px;
  background: transparent;
}

.project-link:hover {
  background: #007bff;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

/* Stats Section */
.stats {
  padding: 6rem 0;
  background: #f9f9f9;
  position: relative;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 3rem;
  text-align: center;
}

.stat-item {
  padding: 2rem;
  background: #f9f9f9;
  border-radius: 12px;
  transition: all 0.3s ease;
  border: 1px solid #e0e0e0;
  position: relative;
  overflow: hidden;
}

.stat-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007bff, #0056b3);
}

.stat-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
  border-color: #007bff;
}

.stat-number {
  font-size: 3rem;
  font-weight: 700;
  color: #007bff;
  margin-bottom: 0.5rem;
  line-height: 1;
}

.stat-label {
  font-size: 1rem;
  color: #666;
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-content {
    flex-direction: column;
    text-align: center;
    gap: 3rem;
  }

  .hero-title {
    font-size: 3rem;
  }

  .hero-buttons {
    justify-content: center;
  }

  .skills-grid {
    grid-template-columns: 1fr;
  }

  .projects-grid {
    grid-template-columns: 1fr;
  }

  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
}

@media (max-width: 480px) {
  .hero {
    padding: 6rem 0;
  }

  .hero-title {
    font-size: 2.5rem;
  }

  .hero-buttons {
    flex-direction: column;
    align-items: center;
  }

  .btn {
    width: 100%;
    text-align: center;
  }

  .image-container {
    width: 250px;
    height: 250px;
  }

  .skills {
    padding: 6rem 0;
  }

  .projects-preview {
    padding: 6rem 0;
  }

  .stats {
    padding: 4rem 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }
}
</style>