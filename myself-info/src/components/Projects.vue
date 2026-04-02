<script setup>
// Projects组件 - 展示个人项目
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
    .from('.project-card', {
      y: 100,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out',
      stagger: 0.2
    }, 0.3)
    .from('.project-image', {
      scale: 0.8,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out',
      stagger: 0.2
    }, 0.5)
    .from('.project-content', {
      y: 50,
      opacity: 0,
      duration: 0.8,
      ease: 'power3.out',
      stagger: 0.2
    }, 0.7)
})

const projects = [
  {
    id: 1,
    title: "电商网站",
    description: "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。",
    technologies: ["Vue 3", "TypeScript", "Vuex", "Element Plus"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20cards%2C%20shopping%20cart%2C%20professional%20look&image_size=landscape_16_9"
  },
  {
    id: 2,
    title: "个人博客",
    description: "基于React和Next.js的个人博客系统，支持Markdown编辑、分类管理和评论功能。",
    technologies: ["React", "Next.js", "Markdown", "Tailwind CSS"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=personal%20blog%20website%20interface%2C%20clean%20design%2C%20blog%20posts%2C%20categories%2C%20modern%20look&image_size=landscape_16_9"
  },
  {
    id: 3,
    title: "任务管理系统",
    description: "使用Vue 3和Firebase构建的任务管理系统，支持任务创建、编辑、删除和状态管理。",
    technologies: ["Vue 3", "Firebase", "Vue Router", "SCSS"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=task%20management%20system%20interface%2C%20task%20cards%2C%20status%20columns%2C%20modern%20design&image_size=landscape_16_9"
  },
  {
    id: 4,
    title: "天气应用",
    description: "使用React和OpenWeather API构建的天气应用，支持实时天气查询和未来天气预报。",
    technologies: ["React", "OpenWeather API", "Axios", "Styled Components"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=weather%20application%20interface%2C%20current%20weather%2C%20forecast%20cards%2C%20modern%20design&image_size=landscape_16_9"
  },
  {
    id: 5,
    title: "社交媒体应用",
    description: "使用Vue 3和Socket.io构建的实时社交媒体应用，支持即时消息和用户互动。",
    technologies: ["Vue 3", "Socket.io", "Node.js", "MongoDB"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=social%20media%20application%20interface%2C%20user%20feed%2C%20messages%2C%20modern%20design&image_size=landscape_16_9"
  },
  {
    id: 6,
    title: "在线教育平台",
    description: "基于React和Express构建的在线教育平台，支持课程管理和视频播放。",
    technologies: ["React", "Express", "MongoDB", "Redux"],
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=online%20education%20platform%20interface%2C%20courses%2C%20video%20player%2C%20modern%20design&image_size=landscape_16_9"
  }
]
</script>

<template>
  <div class="projects">
    <div class="container">
      <div class="section-header" :class="{ 'visible': isVisible }">
        <h2>我的项目</h2>
        <div class="divider"></div>
        <p>这些是我参与开发的一些项目，展示了我的技术能力和项目经验。</p>
      </div>
      
      <div class="projects-grid">
        <div v-for="(project, index) in projects" :key="project.id" class="project-card glass" :class="{ 'visible': isVisible }" :style="{ animationDelay: `${0.2 + index * 0.1}s` }">
          <div class="project-image">
            <img :src="project.image" :alt="project.title" />
            <div class="project-overlay">
              <div class="project-tech">
                <span v-for="(tech, index) in project.technologies" :key="index" class="tech-tag">
                  {{ tech }}
                </span>
              </div>
            </div>
          </div>
          <div class="project-content">
            <h3>{{ project.title }}</h3>
            <p>{{ project.description }}</p>
            <a href="#" class="project-link">查看详情 →</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.projects {
  padding: 5rem 0;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.projects::before {
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

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  position: relative;
  z-index: 1;
}

.project-card {
  overflow: hidden;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  border-radius: 16px;
  transform: translateY(50px);
  opacity: 0;
  animation: fadeInUp 1s ease-out both;
  position: relative;
  overflow: hidden;
}

.project-card::before {
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

.project-card:hover::before {
  left: 100%;
}

.project-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(31, 38, 135, 0.2);
  animation: pulse 1s ease-in-out;
}

.project-image {
  position: relative;
  overflow: hidden;
  height: 200px;
  border-radius: 16px 16px 0 0;
}

.project-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.project-card:hover .project-image img {
  transform: scale(1.1) rotate(2deg);
}

.project-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  align-items: flex-end;
  padding: 1.5rem;
  z-index: 1;
}

.project-card:hover .project-overlay {
  opacity: 1;
  animation: fadeIn 0.5s ease-out;
}

.project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.tech-tag {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  color: #333;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 500;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.tech-tag:hover {
  transform: scale(1.05);
  background: rgba(255, 255, 255, 1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.project-content {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  position: relative;
  z-index: 1;
}

.project-content h3 {
  font-size: 1.3rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 1rem;
  position: relative;
  overflow: hidden;
}

.project-content h3::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #007bff, #0056b3);
  transition: width 0.3s ease;
}

.project-card:hover .project-content h3::after {
  width: 100%;
}

.project-content p {
  color: #555;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  flex: 1;
  position: relative;
  overflow: hidden;
}

.project-content p::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.1), transparent);
  transition: left 0.8s ease;
}

.project-content p:hover::before {
  left: 100%;
}

.project-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
  display: inline-block;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.project-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 123, 255, 0.2), transparent);
  transition: left 0.5s ease;
  z-index: -1;
}

.project-link:hover::before {
  left: 100%;
}

.project-link:hover {
  color: #0056b3;
  transform: translateX(5px);
  animation: pulse 1s ease-in-out;
}

@media (max-width: 768px) {
  .projects-grid {
    grid-template-columns: 1fr;
  }
  
  .project-image {
    height: 150px;
  }
  
  .project-card {
    margin: 0 1rem;
  }
}
</style>