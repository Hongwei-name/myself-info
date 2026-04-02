# 个人作品集网站 - 后端API

## 项目概述

这是个人作品集网站的后端API部分，使用PHP实现，提供RESTful API接口，用于管理个人信息、技能、教育背景、工作经历、项目作品和联系方式等数据。

## 技术栈

- **语言**：PHP 7.4+
- **数据库**：MySQL 5.7+
- **API风格**：RESTful API
- **跨域支持**：CORS

## 项目结构

```
backend/
├── app/                # 应用代码
│   └── Views/          # 后端视图
│       ├── contact.php      # 联系信息管理页面
│       ├── dashboard.php    # 后台控制面板
│       ├── education.php    # 教育背景管理页面
│       ├── experiences.php  # 工作经历管理页面
│       ├── personal.php     # 个人信息管理页面
│       ├── projects.php     # 项目管理页面
│       └── skills.php       # 技能管理页面
├── config/             # 配置文件
│   └── database.php    # 数据库配置
├── error/              # 错误页面
├── public/             # 静态资源
│   └── css/            # CSS文件
├── api.php             # API接口文件
├── index.php           # 后端入口文件
├── .htaccess           # Apache配置
├── nginx.htaccess      # Nginx配置
└── README.md           # 后端README
```

## 安装与运行

### 1. 环境要求
- PHP 7.4+
- MySQL 5.7+
- Apache或Nginx服务器

### 2. 数据库配置
1. **创建数据库**
   - 在MySQL中创建名为 `portfolio` 的数据库

2. **配置数据库连接**
   - 打开 `config/database.php` 文件
   - 修改数据库连接信息：
     ```php
     // 数据库连接信息
     $servername = "localhost";
     $username = "root";
     $password = "root";
     $dbname = "portfolio";
     ```

### 3. 数据库表结构

#### 主要表结构

##### `personal_info` - 个人信息表
- `id` (INT, PRIMARY KEY)
- `name` (VARCHAR) - 姓名
- `title` (VARCHAR) - 职位
- `slogan` (VARCHAR) - 标语
- `description` (TEXT) - 描述
- `avatar` (VARCHAR) - 头像URL
- `phone` (VARCHAR) - 电话号码
- `email` (VARCHAR) - 邮箱
- `university` (VARCHAR) - 大学
- `major` (VARCHAR) - 专业
- `english_cert` (VARCHAR) - 英语证书
- `web_cert` (VARCHAR) - Web工程师证书
- `education_courses` (TEXT) - 教育课程
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `skills` - 技能表
- `id` (INT, PRIMARY KEY)
- `name` (VARCHAR) - 技能名称
- `level` (VARCHAR) - 技能水平
- `category_id` (INT) - 技能分类ID
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `skill_categories` - 技能分类表
- `id` (INT, PRIMARY KEY)
- `name` (VARCHAR) - 分类名称
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `education` - 教育背景表
- `id` (INT, PRIMARY KEY)
- `institution` (VARCHAR) - 机构名称
- `degree` (VARCHAR) - 学位
- `major` (VARCHAR) - 专业
- `start_year` (INT) - 开始年份
- `end_year` (INT) - 结束年份
- `courses` (TEXT) - 课程
- `description` (TEXT) - 描述
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `experiences` - 工作经历表
- `id` (INT, PRIMARY KEY)
- `date` (VARCHAR) - 日期
- `title` (VARCHAR) - 职位
- `company` (VARCHAR) - 公司
- `description` (TEXT) - 描述
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `projects` - 项目表
- `id` (INT, PRIMARY KEY)
- `title` (VARCHAR) - 项目标题
- `description` (TEXT) - 项目描述
- `technologies` (VARCHAR) - 使用技术
- `image` (VARCHAR) - 项目图片
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

##### `contact_info` - 联系方式表
- `id` (INT, PRIMARY KEY)
- `type` (VARCHAR) - 联系方式类型
- `value` (VARCHAR) - 联系方式值
- `icon` (VARCHAR) - 图标
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

### 4. 启动后端服务
- 将后端代码部署到Apache或Nginx服务器
- 确保后端API可以通过 `http://localhost/backend/api.php` 访问

## API接口文档

### 个人信息
- **GET** `/api/personal` - 获取个人信息
- **POST** `/api/personal` - 更新个人信息

### 技能管理
- **GET** `/api/skills` - 获取技能列表
- **POST** `/api/skills` - 添加技能
- **PUT** `/api/skills/{id}` - 更新技能
- **DELETE** `/api/skills/{id}` - 删除技能

### 教育背景
- **GET** `/api/education` - 获取教育背景列表
- **POST** `/api/education` - 添加教育背景
- **PUT** `/api/education/{id}` - 更新教育背景
- **DELETE** `/api/education/{id}` - 删除教育背景

### 工作经历
- **GET** `/api/experiences` - 获取工作经历列表
- **POST** `/api/experiences` - 添加工作经历
- **PUT** `/api/experiences/{id}` - 更新工作经历
- **DELETE** `/api/experiences/{id}` - 删除工作经历

### 项目作品
- **GET** `/api/projects` - 获取项目列表
- **POST** `/api/projects` - 添加项目
- **PUT** `/api/projects/{id}` - 更新项目
- **DELETE** `/api/projects/{id}` - 删除项目

### 联系方式
- **GET** `/api/contact` - 获取联系方式列表
- **POST** `/api/contact` - 添加联系方式
- **PUT** `/api/contact/{id}` - 更新联系方式
- **DELETE** `/api/contact/{id}` - 删除联系方式

### 统计信息
- **GET** `/api/stats` - 获取统计信息

## API请求与响应示例

### 获取个人信息
**请求**：
```
GET /api/personal
```

**响应**：
```json
{
  "id": 1,
  "name": "陈洪伟",
  "title": "数据科学与大数据专业学生",
  "slogan": "热爱编程和数据分析",
  "description": "我是一名数据科学与大数据专业的学生，热爱编程和数据分析。",
  "avatar": "https://i.cetsteam.com/imgs/2026/04/01/f37915722ac27d20.jpg",
  "phone": "18929749359",
  "email": "3485581538@qq.com",
  "university": "桂林电子科技大学",
  "major": "数据科学与大数据",
  "english_cert": "英语四级",
  "web_cert": "初级Web工程师",
  "education_courses": "数据结构、算法设计、操作系统、计算机网络、数据库原理、数据科学、大数据技术、机器学习、Python编程等"
}
```

### 添加技能
**请求**：
```
POST /api/skills
Content-Type: application/json

{
  "name": "Vue.js",
  "level": "85%",
  "category_id": 1
}
```

**响应**：
```json
{
  "success": "Skill added successfully"
}
```

## 注意事项

1. **跨域问题**：后端API已配置CORS头，允许所有跨域请求
2. **数据库连接**：确保数据库连接信息正确配置
3. **API地址**：前端需要根据后端部署地址修改API基础URL
4. **权限控制**：当前API未实现权限控制，仅用于个人作品集展示
5. **数据安全**：生产环境中应添加适当的输入验证和安全措施

## 作者信息

- **姓名**：陈洪伟
- **邮箱**：3485581538@qq.com
- **电话**：18929749359
- **大学**：桂林电子科技大学
- **专业**：数据科学与大数据

## 许可证

本项目仅供个人学习和展示使用，未经授权不得用于商业用途。
