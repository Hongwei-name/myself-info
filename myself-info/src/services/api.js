// API service for fetching data from backend
// Falls back to default data if backend is unavailable

const API_BASE_URL = 'http://localhost/chw/api.php'

// Default data as fallback
const defaultData = {
  personal: {
    name: '陈洪伟',
    title: '前端开发工程师',
    slogan: 'Code Crafts My Reality',
    description: '专注于创建美观、高效的Web应用程序，热爱前端技术，不断学习和探索新的技术栈。',
    avatar: 'https://i.cetsteam.com/imgs/2026/04/01/f37915722ac27d20.jpg',
    phone: '18929749359',
    email: '3485581538@qq.com',
    university: '桂林电子科技大学',
    major: '数据科学与大数据',
    english_cert: '英语四级',
    web_cert: '初级Web工程师',
    education_courses: '数据结构、算法设计、操作系统、计算机网络、数据库原理、数据科学、大数据技术、机器学习、Python编程等'
  },
  skills: [
    { name: 'Vue.js', level: 95 },
    { name: 'React', level: 85 },
    { name: 'JavaScript/TypeScript', level: 90 },
    { name: 'HTML/CSS', level: 95 },
    { name: '数据科学', level: 85 },
    { name: '大数据', level: 80 },
    { name: 'Webpack/Vite', level: 85 },
    { name: 'Git', level: 90 },
    { name: 'Node.js', level: 80 },
    { name: 'Element Plus/Ant Design', level: 85 },
    { name: 'MySQL', level: 85 },
    { name: 'Python', level: 75 }
  ],
  experiences: [
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
  ],
  projects: [
    {
      title: '电商网站',
      description: '使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。',
      technologies: 'Vue 3, TypeScript, Vuex, Element Plus, Axios',
      tech: ['Vue 3', 'TypeScript', 'Vuex', 'Element Plus', 'Axios'],
      github: true,
      demo: true,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9'
    },
    {
      title: '个人博客',
      description: '基于React和Next.js开发的个人博客系统，支持Markdown编辑和主题切换。该项目使用了Tailwind CSS进行样式设计，Firebase作为后端服务。',
      technologies: 'React, Next.js, Tailwind CSS, Firebase, Markdown',
      tech: ['React', 'Next.js', 'Tailwind CSS', 'Firebase', 'Markdown'],
      github: true,
      demo: true,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=personal%20blog%20website%20interface%2C%20minimalist%20design%2C%20article%20list%2C%20clean%20layout&image_size=landscape_16_9'
    },
    {
      title: '管理系统',
      description: '使用Vue 3和Element Plus构建的后台管理系统，包含用户管理、权限控制等功能。该项目采用了Vue Router进行路由管理，Axios进行API调用。',
      technologies: 'Vue 3, Element Plus, Vue Router, Axios, Vuex',
      tech: ['Vue 3', 'Element Plus', 'Vue Router', 'Axios', 'Vuex'],
      github: true,
      demo: false,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=admin%20dashboard%20interface%2C%20modern%20design%2C%20data%20visualization%2C%20professional%20layout&image_size=landscape_16_9'
    },
    {
      title: '移动应用',
      description: '使用React Native开发的移动应用，包含用户认证、数据展示等功能。该项目使用了Redux进行状态管理，React Navigation进行导航管理。',
      technologies: 'React Native, Redux, React Navigation, Axios, Firebase',
      tech: ['React Native', 'Redux', 'React Navigation', 'Axios', 'Firebase'],
      github: true,
      demo: false,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=mobile%20app%20interface%2C%20modern%20design%2C%20user%20profile%2C%20clean%20layout&image_size=portrait_4_3'
    },
    {
      title: '数据可视化平台',
      description: '使用D3.js和React开发的数据可视化平台，支持多种图表类型和数据交互。该项目使用了Redux进行状态管理，React Router进行路由管理。',
      technologies: 'React, D3.js, Redux, React Router, Tailwind CSS',
      tech: ['React', 'D3.js', 'Redux', 'React Router', 'Tailwind CSS'],
      github: true,
      demo: true,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=data%20visualization%20dashboard%2C%20charts%20and%20graphs%2C%20modern%20design%2C%20professional%20layout&image_size=landscape_16_9'
    },
    {
      title: '在线教育平台',
      description: '使用Vue 3和TypeScript构建的在线教育平台，包含课程管理、学习进度跟踪等功能。该项目使用了Vuex进行状态管理，Element Plus作为UI组件库。',
      technologies: 'Vue 3, TypeScript, Vuex, Element Plus, Axios',
      tech: ['Vue 3', 'TypeScript', 'Vuex', 'Element Plus', 'Axios'],
      github: true,
      demo: false,
      image: 'https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=online%20education%20platform%20interface%2C%20course%20list%2C%20modern%20design%2C%20professional%20layout&image_size=landscape_16_9'
    }
  ],
  contact: [
    { icon: '📧', title: '邮箱', value: '3485581538@qq.com' },
    { icon: '💬', title: '微信', value: 'chenhongwei' },
    { icon: '📱', title: '电话', value: '18929749359' }
  ]
}

// Fetch with timeout and error handling
async function fetchWithTimeout(url, options = {}, timeout = 5000) {
  const controller = new AbortController()
  const id = setTimeout(() => controller.abort(), timeout)
  
  try {
    const response = await fetch(url, {
      ...options,
      signal: controller.signal
    })
    clearTimeout(id)
    return response
  } catch (error) {
    clearTimeout(id)
    throw error
  }
}

// API functions
export const api = {
  // Get personal info
  async getPersonalInfo() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/personal`)
      if (!response.ok) throw new Error('Failed to fetch personal info')
      const data = await response.json()
      return { success: true, data: { ...defaultData.personal, ...data } }
    } catch (error) {
      console.warn('Backend unavailable, using default personal info:', error.message)
      return { success: false, data: defaultData.personal }
    }
  },

  // Get skills
  async getSkills() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/skills`)
      if (!response.ok) throw new Error('Failed to fetch skills')
      const data = await response.json()
      if (Array.isArray(data) && data.length > 0) {
        return { success: true, data: data.map(skill => ({
          name: skill.name,
          level: parseInt(skill.level) || 80,
          category: skill.category_name || '其他'
        })) }
      }
      throw new Error('Invalid skills data')
    } catch (error) {
      console.warn('Backend unavailable, using default skills:', error.message)
      return { success: false, data: defaultData.skills }
    }
  },

  // Get experiences
  async getExperiences() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/experiences`)
      if (!response.ok) throw new Error('Failed to fetch experiences')
      const data = await response.json()
      if (Array.isArray(data) && data.length > 0) {
        return { success: true, data }
      }
      throw new Error('Invalid experiences data')
    } catch (error) {
      console.warn('Backend unavailable, using default experiences:', error.message)
      return { success: false, data: defaultData.experiences }
    }
  },

  // Get projects
  async getProjects() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/projects`)
      if (!response.ok) throw new Error('Failed to fetch projects')
      const data = await response.json()
      if (Array.isArray(data) && data.length > 0) {
        return { 
          success: true, 
          data: data.map(project => ({
            ...project,
            tech: project.technologies ? project.technologies.split(',').map(t => t.trim()) : [],
            github: true,
            demo: true
          })) 
        }
      }
      throw new Error('Invalid projects data')
    } catch (error) {
      console.warn('Backend unavailable, using default projects:', error.message)
      return { success: false, data: defaultData.projects }
    }
  },

  // Get contact info
  async getContactInfo() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/contact`)
      if (!response.ok) throw new Error('Failed to fetch contact info')
      const data = await response.json()
      if (Array.isArray(data) && data.length > 0) {
        return { 
          success: true, 
          data: data.map(contact => ({
            icon: contact.icon || '📧',
            title: contact.type,
            value: contact.value
          })) 
        }
      }
      throw new Error('Invalid contact data')
    } catch (error) {
      console.warn('Backend unavailable, using default contact info:', error.message)
      return { success: false, data: defaultData.contact }
    }
  },

  // Get stats
  async getStats() {
    try {
      const response = await fetchWithTimeout(`${API_BASE_URL}/api/stats`)
      if (!response.ok) throw new Error('Failed to fetch stats')
      const data = await response.json()
      if (data) {
        return { success: true, data }
      }
      throw new Error('Invalid stats data')
    } catch (error) {
      console.warn('Backend unavailable, using default stats:', error.message)
      return { success: false, data: { experience: 3, projects: 20, skills: 15, clients: 10 } }
    }
  }
}

export default api