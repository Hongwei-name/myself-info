<template>
  <div class="projects">
    <!-- Projects Section -->
    <section class="projects-section">
      <div class="container">
        <h2 class="section-title">我的项目</h2>
        <p class="section-description">
          以下是我参与开发的一些项目，展示了我的技术能力和项目经验。
        </p>
        <div class="projects-grid">
          <div class="project-card" v-for="(project, index) in projects" :key="index" @mouseenter="handleProjectCardHover(index, true)" @mouseleave="handleProjectCardHover(index, false)">
            <div class="project-card-inner" :ref="el => projectCardRefs[index] = el">
              <div class="project-card-front">
                <div class="project-image">
                  <img :src="project.image" :alt="project.title" />
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
                  <a href="#" class="project-link" v-if="project.github">GitHub</a>
                  <a href="#" class="project-link" v-if="project.demo">Demo</a>
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

const projectCardRefs = ref([])

// Reactive data from API
const projects = ref([
  {
    title: "电商网站",
    description: "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
    tech: ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
    github: true,
    demo: true,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
  },
  {
    title: "个人博客",
    description: "基于React和Next.js开发的个人博客系统，支持Markdown编辑和主题切换。该项目使用了Tailwind CSS进行样式设计，Firebase作为后端服务。",
    tech: ["React", "Next.js", "Tailwind CSS", "Firebase", "Markdown"],
    github: true,
    demo: true,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=personal%20blog%20website%20interface%2C%20minimalist%20design%2C%20article%20list%2C%20clean%20layout&image_size=landscape_16_9"
  },
  {
    title: "管理系统",
    description: "使用Vue 3和Element Plus构建的后台管理系统，包含用户管理、权限控制等功能。该项目采用了Vue Router进行路由管理，Axios进行API调用。",
    tech: ["Vue 3", "Element Plus", "Vue Router", "Axios", "Vuex"],
    github: true,
    demo: false,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=admin%20dashboard%20interface%2C%20modern%20design%2C%20data%20visualization%2C%20professional%20layout&image_size=landscape_16_9"
  },
  {
    title: "移动应用",
    description: "使用React Native开发的移动应用，包含用户认证、数据展示等功能。该项目使用了Redux进行状态管理，React Navigation进行导航管理。",
    tech: ["React Native", "Redux", "React Navigation", "Axios", "Firebase"],
    github: true,
    demo: false,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=mobile%20app%20interface%2C%20modern%20design%2C%20user%20profile%2C%20clean%20layout&image_size=portrait_4_3"
  },
  {
    title: "数据可视化平台",
    description: "使用D3.js和React开发的数据可视化平台，支持多种图表类型和数据交互。该项目使用了Redux进行状态管理，React Router进行路由管理。",
    tech: ["React", "D3.js", "Redux", "React Router", "Tailwind CSS"],
    github: true,
    demo: true,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=data%20visualization%20dashboard%2C%20charts%20and%20graphs%2C%20modern%20design%2C%20professional%20layout&image_size=landscape_16_9"
  },
  {
    title: "在线教育平台",
    description: "使用Vue 3和TypeScript构建的在线教育平台，包含课程管理、学习进度跟踪等功能。该项目使用了Vuex进行状态管理，Element Plus作为UI组件库。",
    tech: ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
    github: true,
    demo: false,
    image: "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=online%20education%20platform%20interface%2C%20course%20list%2C%20modern%20design%2C%20professional%20layout&image_size=landscape_16_9"
  }
])

// Fetch data from API
const fetchData = async () => {
  const projectsResult = await api.getProjects()
  if (projectsResult.success && projectsResult.data.length > 0) {
    projects.value = projectsResult.data
  }
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

  // Projects Animation
  // Projects Animation
  gsap.from('.project-card', {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.2,
    ease: 'power2.out'
  })
  

})
</script>

<style scoped>
/* Projects Section */
.projects-section {
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

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
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

/* Responsive Design */
@media (max-width: 768px) {
  .projects-grid {
    grid-template-columns: 1fr;
  }

  .project-card {
    height: 350px;
  }
}

@media (max-width: 480px) {
  .projects-section {
    padding: 6rem 0;
  }

  .section-title {
    font-size: 2rem;
  }

  .project-card {
    height: 300px;
  }

  .project-card-back {
    padding: 1.5rem;
  }

  .project-image-overlay {
    padding: 1.5rem;
  }

  .project-title {
    font-size: 1.25rem;
  }

  .project-description {
    font-size: 0.9rem;
  }
}
</style>