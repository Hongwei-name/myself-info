<script setup>
// AboutMe组件 - 关于我部分，包含个人信息、技能和经历
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
    .from('.about-content', {
      y: 100,
      opacity: 0,
      duration: 1,
      ease: 'power3.out'
    }, 0.3)
    .from('.about-text', {
      x: -100,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out'
    }, 0.5)
    .from('.skills', {
      x: 100,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out'
    }, 0.7)
    .from('.skill-item', {
      y: 50,
      opacity: 0,
      duration: 0.6,
      ease: 'power3.out',
      stagger: 0.1
    }, 0.9)
    .from('.skill-progress', {
      width: 0,
      duration: 1.5,
      ease: 'power2.out',
      stagger: 0.1
    }, 1.1)
    .from('.experience', {
      y: 100,
      opacity: 0,
      duration: 1,
      ease: 'power3.out'
    }, 1.3)
    .from('.timeline-item', {
      y: 50,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out',
      stagger: 0.2
    }, 1.5)
})
</script>

<template>
  <div class="about">
    <div class="container">
      <div class="section-header" :class="{ 'visible': isVisible }">
        <h2>关于我</h2>
        <div class="divider"></div>
      </div>
      
      <div class="about-content glass" :class="{ 'visible': isVisible }">
        <div class="about-text">
          <p>我是陈洪伟，一名前端开发工程师，热衷于创建美观、高效的Web应用程序。我拥有多年的前端开发经验，熟悉现代前端技术栈，包括Vue、React、JavaScript等。</p>
          <p>我热爱编程，不断学习和探索新的技术，致力于提升自己的技术水平。我相信技术的力量可以改变世界，希望通过我的工作为用户带来更好的体验。</p>
          <p>除了编程，我还喜欢阅读、旅游和运动。这些爱好让我保持活力，也为我的工作带来灵感。</p>
        </div>
        
        <div class="skills">
          <h3>技能</h3>
          <div class="skills-container">
            <div class="skills-wrapper">
              <div class="skill-tag" v-for="(skill, index) in skills" :key="skill.name">
                <span class="skill-name">{{ skill.name }}</span>
                <span class="skill-level">{{ skill.level }}</span>
              </div>
              <div class="skill-tag" v-for="(skill, index) in skills" :key="skill.name + '-copy'">
                <span class="skill-name">{{ skill.name }}</span>
                <span class="skill-level">{{ skill.level }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="experience" :class="{ 'visible': isVisible }">
        <h3>经历</h3>
        <div class="timeline">
          <div class="timeline-item" v-for="(item, index) in experiences" :key="index" :style="{ animationDelay: `${0.5 + index * 0.2}s` }">
            <div class="timeline-date">{{ item.date }}</div>
            <div class="timeline-content glass">
              <h4>{{ item.title }}</h4>
              <p>{{ item.company }}</p>
              <p>{{ item.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      skills: [
        { name: 'Vue.js', level: '90%' },
        { name: 'React', level: '85%' },
        { name: 'JavaScript', level: '95%' },
        { name: 'HTML/CSS', level: '92%' },
        { name: 'TypeScript', level: '80%' },
        { name: 'Node.js', level: '75%' }
      ],
      experiences: [
        {
          date: '2025 - 2027',
          title: '数据科学与大数据专业',
          company: '桂林电子科技大学',
          description: '主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。'
        },
        {
          date: '2022 - 2025',
          title: '软件技术专业',
          company: '广西机电职业技术学院',
          description: '学习软件技术相关课程，掌握编程基础、前端开发等技能。'
        },
        {
          date: '2024 - 至今',
          title: '高级前端开发工程师',
          company: '某科技公司',
          description: '负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。'
        },
        {
          date: '2022 - 2024',
          title: '前端开发工程师',
          company: '某互联网公司',
          description: '参与多个项目的前端开发，使用React和JavaScript构建响应式Web应用。'
        },
        {
          date: '2024',
          title: '证书',
          company: '相关机构',
          description: '获得英语四级证书和初级Web工程师证书。'
        }
      ]
    }
  }
}
</script>

<style scoped>
.about {
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.about::before {
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

.about-content {
  display: flex;
  gap: 4rem;
  margin-bottom: 4rem;
  padding: 3rem;
  transform: translateY(50px);
  opacity: 0;
  transition: all 1s ease-out 0.3s;
  position: relative;
  z-index: 1;
  border-radius: 24px;
}

.about-content.visible {
  transform: translateY(0);
  opacity: 1;
}

.about-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(31, 38, 135, 0.2);
}

.about-text {
  flex: 1;
  font-size: 1.1rem;
  line-height: 1.6;
  color: #555;
  animation: fadeInLeft 1s ease-out 0.5s both;
}

.about-text p {
  margin-bottom: 1.5rem;
  position: relative;
  overflow: hidden;
}

.about-text p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.about-text p:hover::before {
  left: 100%;
}

.skills {
  flex: 1;
  animation: fadeInRight 1s ease-out 0.7s both;
}

.skills h3 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
  position: relative;
  overflow: hidden;
}

.skills h3::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.skills h3:hover::before {
  left: 100%;
}

.skills-container {
  overflow: hidden;
  position: relative;
  width: 100%;
  padding: 1rem 0;
}

.skills-wrapper {
  display: flex;
  gap: 1rem;
  animation: scroll-left 20s linear infinite;
  will-change: transform;
}

.skills-wrapper:hover {
  animation-play-state: paused;
}

@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.skill-tag {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 50px;
  white-space: nowrap;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
}

.skill-tag:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(0, 123, 255, 0.2);
  background: rgba(255, 255, 255, 0.3);
}

.skill-name {
  font-weight: 500;
  color: #333;
}

.skill-level {
  font-size: 0.875rem;
  font-weight: 600;
  color: #007bff;
  background: rgba(0, 123, 255, 0.1);
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  border: 1px solid rgba(0, 123, 255, 0.2);
}

@keyframes shimmer {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
}

.experience {
  margin-top: 4rem;
  transform: translateY(50px);
  opacity: 0;
  transition: all 1s ease-out 0.5s;
  position: relative;
  z-index: 1;
}

.experience.visible {
  transform: translateY(0);
  opacity: 1;
}

.experience h3 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 2rem;
  text-align: center;
  animation: fadeInDown 1s ease-out 0.7s both;
  position: relative;
  overflow: hidden;
}

.experience h3::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.experience h3:hover::before {
  left: 100%;
}

.timeline {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
}

.timeline::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  background: linear-gradient(180deg, #007bff, #0056b3);
  animation: growVertical 2s ease-out 1s both;
}

@keyframes growVertical {
  from {
    height: 0;
  }
  to {
    height: 100%;
  }
}

.timeline-item {
  position: relative;
  margin-bottom: 2rem;
  display: flex;
  opacity: 0;
  transform: translateY(30px);
  animation: fadeInUp 1s ease-out both;
}

.timeline-item:nth-child(odd) {
  flex-direction: row;
}

.timeline-item:nth-child(even) {
  flex-direction: row-reverse;
}

.timeline-date {
  flex: 0 0 200px;
  padding: 1rem;
  background: linear-gradient(90deg, #007bff, #0056b3);
  color: white;
  border-radius: 12px;
  font-weight: 600;
  text-align: center;
  position: relative;
  box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
  transition: all 0.3s ease;
  overflow: hidden;
}

.timeline-date::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.timeline-date:hover::before {
  left: 100%;
}

.timeline-date:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.4);
}

.timeline-date::after {
  content: '';
  position: absolute;
  top: 50%;
  width: 20px;
  height: 20px;
  background: linear-gradient(45deg, #007bff, #0056b3);
  border-radius: 50%;
  transform: translateY(-50%);
  box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
  animation: pulse 2s ease-in-out infinite;
}

.timeline-item:nth-child(odd) .timeline-date::after {
  right: -10px;
}

.timeline-item:nth-child(even) .timeline-date::after {
  left: -10px;
}

.timeline-content {
  flex: 1;
  padding: 1.5rem;
  margin: 0 2rem;
  transition: all 0.3s ease;
  border-radius: 16px;
  position: relative;
  overflow: hidden;
}

.timeline-content::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.5s ease;
}

.timeline-content:hover::before {
  left: 100%;
}

.timeline-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(31, 38, 135, 0.2);
}

.timeline-content h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 0.5rem;
  position: relative;
  overflow: hidden;
}

.timeline-content h4::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  transition: width 0.3s ease;
}

.timeline-content:hover h4::after {
  width: 100%;
}

.timeline-content p {
  color: #555;
  margin-bottom: 0.5rem;
  line-height: 1.5;
}

@media (max-width: 768px) {
  .about-content {
    flex-direction: column;
    gap: 2rem;
    padding: 2rem;
  }
  
  .timeline::before {
    left: 0;
  }
  
  .timeline-item {
    flex-direction: row !important;
  }
  
  .timeline-date {
    flex: 0 0 150px;
  }
  
  .timeline-date::after {
    left: -10px !important;
  }
  
  .timeline-content {
    margin: 0 1rem;
  }
}
</style>