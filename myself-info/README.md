# 个人简历网站

## 项目介绍

这是一个基于 Vue 3 + Vite 构建的个人简历网站，用于展示个人信息、教育背景、工作经历、技能和项目经验。网站采用现代化的设计风格，具有流畅的动画效果和响应式布局，适配各种设备屏幕。

## 功能特点

- **现代化设计**：采用玻璃态设计风格，结合渐变色彩和微妙动画，营造出时尚、专业的视觉效果
- **响应式布局**：适配桌面端、平板和移动设备，提供良好的跨设备体验
- **流畅动画**：使用 GSAP 实现平滑的页面过渡和元素动画效果
- **模块化结构**：采用组件化开发方式，代码结构清晰，易于维护和扩展
- **技能展示**：使用动态滚动的胶囊式布局展示专业技能
- **项目展示**：使用卡片式布局展示项目经验，支持悬停效果
- **联系信息**：清晰展示联系方式，方便潜在雇主或合作伙伴联系

## 技术栈

- **前端框架**：Vue 3
- **构建工具**：Vite
- **路由管理**：Vue Router
- **动画库**：GSAP
- **样式**：原生 CSS
- **图标**：阿里巴巴图标库

## 项目结构

```
myself-info/
├── public/              # 静态资源
│   ├── favicon.svg      # 网站图标
│   └── icons.svg        # 自定义图标
├── src/
│   ├── components/      # 通用组件
│   │   ├── About.vue    # 关于页面组件
│   │   ├── AboutMe.vue  # 个人信息组件
│   │   ├── Contact.vue  # 联系页面组件
│   │   ├── Footer.vue   # 页脚组件
│   │   ├── Hero.vue     # 首页英雄区组件
│   │   └── Projects.vue # 项目页面组件
│   ├── router/          # 路由配置
│   │   └── index.js     # 路由定义
│   ├── views/           # 页面视图
│   │   ├── About.vue    # 关于页面
│   │   ├── Contact.vue  # 联系页面
│   │   ├── Home.vue     # 首页
│   │   └── Projects.vue # 项目页面
│   ├── App.vue          # 根组件
│   ├── main.js          # 应用入口
│   └── style.css        # 全局样式
├── index.html           # HTML 模板
├── package.json         # 项目配置和依赖
├── vite.config.js       # Vite 配置
└── README.md            # 项目说明文档
```

## 安装和运行

### 安装依赖

```bash
npm install
```

### 开发模式运行

```bash
npm run dev
```

### 构建生产版本

```bash
npm run build
```

### 预览生产版本

```bash
npm run preview
```

## 页面说明

### 首页
- 个人简介和标语
- 专业技能展示（动态滚动的胶囊式布局）
- 精选项目预览
- 统计数据展示

### 关于页
- 个人详细信息
- 教育背景
- 工作经历
- 技术技能（进度条展示）

### 项目页
- 项目列表展示
- 项目详情（包含技术栈和描述）
- 项目卡片悬停效果

### 联系页
- 联系信息（邮箱、微信、电话）
- 联系表单

## 管理页面功能接口

### 1. 个人信息管理

#### 1.1 获取个人信息
- **接口**：`GET /api/profile`
- **功能**：获取个人基本信息，包括姓名、性别、年龄、联系方式等
- **响应示例**：
  ```json
  {
    "id": 1,
    "name": "陈洪伟",
    "email": "3485581538@qq.com",
    "phone": "18929749359",
    "wechat": "chenhongwei",
    "school": "桂林电子科技大学",
    "major": "数据科学与大数据",
    "certificates": ["英语四级", "初级Web工程师"],
    "bio": "我是一名前端开发工程师，拥有多年的Web开发经验。我热爱前端技术，不断学习和探索新的技术栈，致力于创建美观、高效的Web应用程序。"
  }
  ```

#### 1.2 更新个人信息
- **接口**：`PUT /api/profile`
- **功能**：更新个人基本信息
- **请求示例**：
  ```json
  {
    "name": "陈洪伟",
    "email": "3485581538@qq.com",
    "phone": "18929749359",
    "wechat": "chenhongwei",
    "school": "桂林电子科技大学",
    "major": "数据科学与大数据",
    "certificates": ["英语四级", "初级Web工程师"],
    "bio": "我是一名前端开发工程师，拥有多年的Web开发经验。我热爱前端技术，不断学习和探索新的技术栈，致力于创建美观、高效的Web应用程序。"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "个人信息更新成功",
    "data": {
      "id": 1,
      "name": "陈洪伟",
      "email": "3485581538@qq.com",
      "phone": "18929749359",
      "wechat": "chenhongwei",
      "school": "桂林电子科技大学",
      "major": "数据科学与大数据",
      "certificates": ["英语四级", "初级Web工程师"],
      "bio": "我是一名前端开发工程师，拥有多年的Web开发经验。我热爱前端技术，不断学习和探索新的技术栈，致力于创建美观、高效的Web应用程序。"
    }
  }
  ```

### 2. 教育背景管理

#### 2.1 获取教育背景列表
- **接口**：`GET /api/education`
- **功能**：获取教育背景列表
- **响应示例**：
  ```json
  [
    {
      "id": 1,
      "school": "桂林电子科技大学",
      "major": "数据科学与大数据",
      "degree": "本科",
      "startDate": "2025-09-01",
      "endDate": "2027-06-30",
      "description": "主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。"
    },
    {
      "id": 2,
      "school": "广西机电职业技术学院",
      "major": "软件技术",
      "degree": "专科",
      "startDate": "2022-09-01",
      "endDate": "2025-06-30",
      "description": "学习软件技术相关课程，掌握编程基础、前端开发等技能。"
    }
  ]
  ```

#### 2.2 添加教育背景
- **接口**：`POST /api/education`
- **功能**：添加教育背景
- **请求示例**：
  ```json
  {
    "school": "桂林电子科技大学",
    "major": "数据科学与大数据",
    "degree": "本科",
    "startDate": "2025-09-01",
    "endDate": "2027-06-30",
    "description": "主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "教育背景添加成功",
    "data": {
      "id": 1,
      "school": "桂林电子科技大学",
      "major": "数据科学与大数据",
      "degree": "本科",
      "startDate": "2025-09-01",
      "endDate": "2027-06-30",
      "description": "主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。"
    }
  }
  ```

#### 2.3 更新教育背景
- **接口**：`PUT /api/education/:id`
- **功能**：更新教育背景
- **请求示例**：
  ```json
  {
    "school": "桂林电子科技大学",
    "major": "数据科学与大数据",
    "degree": "本科",
    "startDate": "2025-09-01",
    "endDate": "2027-06-30",
    "description": "主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "教育背景更新成功",
    "data": {
      "id": 1,
      "school": "桂林电子科技大学",
      "major": "数据科学与大数据",
      "degree": "本科",
      "startDate": "2025-09-01",
      "endDate": "2027-06-30",
      "description": "主修数据科学与大数据相关课程，掌握数据分析、机器学习等技能。"
    }
  }
  ```

#### 2.4 删除教育背景
- **接口**：`DELETE /api/education/:id`
- **功能**：删除教育背景
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "教育背景删除成功"
  }
  ```

### 3. 工作经历管理

#### 3.1 获取工作经历列表
- **接口**：`GET /api/experience`
- **功能**：获取工作经历列表
- **响应示例**：
  ```json
  [
    {
      "id": 1,
      "company": "某科技公司",
      "position": "高级前端开发工程师",
      "startDate": "2024-01-01",
      "endDate": "至今",
      "description": "负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。"
    },
    {
      "id": 2,
      "company": "某互联网公司",
      "position": "前端开发工程师",
      "startDate": "2022-01-01",
      "endDate": "2024-01-01",
      "description": "参与多个项目的前端开发，使用React和JavaScript构建响应式Web应用。"
    }
  ]
  ```

#### 3.2 添加工作经历
- **接口**：`POST /api/experience`
- **功能**：添加工作经历
- **请求示例**：
  ```json
  {
    "company": "某科技公司",
    "position": "高级前端开发工程师",
    "startDate": "2024-01-01",
    "endDate": "至今",
    "description": "负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "工作经历添加成功",
    "data": {
      "id": 1,
      "company": "某科技公司",
      "position": "高级前端开发工程师",
      "startDate": "2024-01-01",
      "endDate": "至今",
      "description": "负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。"
    }
  }
  ```

#### 3.3 更新工作经历
- **接口**：`PUT /api/experience/:id`
- **功能**：更新工作经历
- **请求示例**：
  ```json
  {
    "company": "某科技公司",
    "position": "高级前端开发工程师",
    "startDate": "2024-01-01",
    "endDate": "至今",
    "description": "负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "工作经历更新成功",
    "data": {
      "id": 1,
      "company": "某科技公司",
      "position": "高级前端开发工程师",
      "startDate": "2024-01-01",
      "endDate": "至今",
      "description": "负责公司核心产品的前端开发，使用Vue 3和TypeScript构建现代化的Web应用。"
    }
  }
  ```

#### 3.4 删除工作经历
- **接口**：`DELETE /api/experience/:id`
- **功能**：删除工作经历
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "工作经历删除成功"
  }
  ```

### 4. 技能管理

#### 4.1 获取技能列表
- **接口**：`GET /api/skills`
- **功能**：获取技能列表
- **响应示例**：
  ```json
  [
    {
      "id": 1,
      "name": "Vue.js",
      "level": 95,
      "category": "前端技术"
    },
    {
      "id": 2,
      "name": "React",
      "level": 85,
      "category": "前端技术"
    },
    {
      "id": 3,
      "name": "JavaScript/TypeScript",
      "level": 90,
      "category": "前端技术"
    },
    {
      "id": 4,
      "name": "HTML/CSS",
      "level": 95,
      "category": "前端技术"
    },
    {
      "id": 5,
      "name": "数据科学",
      "level": 85,
      "category": "前端技术"
    },
    {
      "id": 6,
      "name": "大数据",
      "level": 80,
      "category": "前端技术"
    },
    {
      "id": 7,
      "name": "Webpack/Vite",
      "level": 85,
      "category": "工具与框架"
    },
    {
      "id": 8,
      "name": "Git",
      "level": 90,
      "category": "工具与框架"
    },
    {
      "id": 9,
      "name": "Node.js",
      "level": 80,
      "category": "工具与框架"
    },
    {
      "id": 10,
      "name": "Element Plus/Ant Design",
      "level": 85,
      "category": "工具与框架"
    },
    {
      "id": 11,
      "name": "MySQL",
      "level": 85,
      "category": "工具与框架"
    },
    {
      "id": 12,
      "name": "Python",
      "level": 75,
      "category": "工具与框架"
    }
  ]
  ```

#### 4.2 添加技能
- **接口**：`POST /api/skills`
- **功能**：添加技能
- **请求示例**：
  ```json
  {
    "name": "Vue.js",
    "level": 95,
    "category": "前端技术"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "技能添加成功",
    "data": {
      "id": 1,
      "name": "Vue.js",
      "level": 95,
      "category": "前端技术"
    }
  }
  ```

#### 4.3 更新技能
- **接口**：`PUT /api/skills/:id`
- **功能**：更新技能
- **请求示例**：
  ```json
  {
    "name": "Vue.js",
    "level": 95,
    "category": "前端技术"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "技能更新成功",
    "data": {
      "id": 1,
      "name": "Vue.js",
      "level": 95,
      "category": "前端技术"
    }
  }
  ```

#### 4.4 删除技能
- **接口**：`DELETE /api/skills/:id`
- **功能**：删除技能
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "技能删除成功"
  }
  ```

### 5. 项目管理

#### 5.1 获取项目列表
- **接口**：`GET /api/projects`
- **功能**：获取项目列表
- **响应示例**：
  ```json
  [
    {
      "id": 1,
      "title": "电商网站",
      "description": "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
      "tech": ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
      "github": true,
      "demo": true,
      "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
    },
    {
      "id": 2,
      "title": "个人博客",
      "description": "基于React和Next.js开发的个人博客系统，支持Markdown编辑和主题切换。该项目使用了Tailwind CSS进行样式设计，Firebase作为后端服务。",
      "tech": ["React", "Next.js", "Tailwind CSS", "Firebase", "Markdown"],
      "github": true,
      "demo": true,
      "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=personal%20blog%20website%20interface%2C%20minimalist%20design%2C%20article%20list%2C%20clean%20layout&image_size=landscape_16_9"
    }
  ]
  ```

#### 5.2 添加项目
- **接口**：`POST /api/projects`
- **功能**：添加项目
- **请求示例**：
  ```json
  {
    "title": "电商网站",
    "description": "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
    "tech": ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
    "github": true,
    "demo": true,
    "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "项目添加成功",
    "data": {
      "id": 1,
      "title": "电商网站",
      "description": "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
      "tech": ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
      "github": true,
      "demo": true,
      "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
    }
  }
  ```

#### 5.3 更新项目
- **接口**：`PUT /api/projects/:id`
- **功能**：更新项目
- **请求示例**：
  ```json
  {
    "title": "电商网站",
    "description": "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
    "tech": ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
    "github": true,
    "demo": true,
    "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "项目更新成功",
    "data": {
      "id": 1,
      "title": "电商网站",
      "description": "使用Vue 3和TypeScript构建的现代化电商网站，包含商品展示、购物车、支付等功能。该项目采用了组件化开发方式，使用Vuex进行状态管理，Element Plus作为UI组件库。",
      "tech": ["Vue 3", "TypeScript", "Vuex", "Element Plus", "Axios"],
      "github": true,
      "demo": true,
      "image": "https://trae-api-cn.mchost.guru/api/ide/v1/text_to_image?prompt=modern%20e-commerce%20website%20interface%2C%20clean%20design%2C%20product%20showcase%2C%20professional%20layout&image_size=landscape_16_9"
    }
  }
  ```

#### 5.4 删除项目
- **接口**：`DELETE /api/projects/:id`
- **功能**：删除项目
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "项目删除成功"
  }
  ```

### 6. 统计数据管理

#### 6.1 获取统计数据
- **接口**：`GET /api/stats`
- **功能**：获取统计数据，包括开发经验年限、完成项目数、掌握技能数、合作客户数等
- **响应示例**：
  ```json
  {
    "experience": 3,
    "projects": 20,
    "skills": 15,
    "clients": 10
  }
  ```

#### 6.2 更新统计数据
- **接口**：`PUT /api/stats`
- **功能**：更新统计数据
- **请求示例**：
  ```json
  {
    "experience": 3,
    "projects": 20,
    "skills": 15,
    "clients": 10
  }
  ```
- **响应示例**：
  ```json
  {
    "success": true,
    "message": "统计数据更新成功",
    "data": {
      "experience": 3,
      "projects": 20,
      "skills": 15,
      "clients": 10
    }
  }
  ```

## 部署说明

### 静态部署

1. 构建生产版本：
   ```bash
   npm run build
   ```

2. 将 `dist` 目录下的文件部署到静态网站托管服务，如：
   - GitHub Pages
   - Vercel
   - Netlify
   - 阿里云OSS
   - 腾讯云COS

### 容器部署

1. 创建 `Dockerfile`：
   ```dockerfile
   FROM nginx:alpine
   COPY dist /usr/share/nginx/html
   EXPOSE 80
   ```

2. 构建镜像：
   ```bash
   docker build -t myself-info .
   ```

3. 运行容器：
   ```bash
   docker run -p 8080:80 myself-info
   ```

## 许可证

MIT

## 联系方式

- 邮箱：3485581538@qq.com
- 电话：18929749359
- 微信：chenhongwei
