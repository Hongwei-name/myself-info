# 个人作品集网站 - 前后端分离系统

## 项目概述

这是一个个人作品集网站，采用前后端分离的架构设计。前端使用Vue 3框架构建，后端使用PHP提供API接口，数据库使用MySQL存储数据。网站主要功能包括：

- 个人信息展示
- 技能展示与管理
- 教育背景展示与管理
- 工作经历展示与管理
- 项目作品展示与管理
- 联系方式管理

## 技术栈

### 前端
- **框架**：Vue 3
- **路由**：Vue Router 4
- **动画**：GSAP 3
- **构建工具**：Vite

### 后端
- **语言**：PHP 7+
- **数据库**：MySQL
- **API**：RESTful API

## 项目结构

```
├── backend/                # 后端代码
│   ├── app/                # 应用代码
│   │   └── Views/          # 后端视图
│   ├── config/             # 配置文件
│   │   └── database.php    # 数据库配置
│   ├── error/              # 错误页面
│   ├── public/             # 静态资源
│   │   └── css/            # CSS文件
│   ├── api.php             # API接口文件
│   ├── index.php           # 后端入口文件
│   └── .htaccess           # Apache配置
├── myself-info/            # 前端代码
│   ├── public/             # 静态资源
│   ├── src/                # 源代码
│   │   ├── components/     # Vue组件
│   │   ├── router/         # 路由配置
│   │   ├── services/       # 服务层
│   │   ├── views/          # 页面视图
│   │   ├── App.vue         # 根组件
│   │   ├── main.js         # 入口文件
│   │   └── style.css       # 全局样式
│   ├── .gitignore          # Git忽略文件
│   ├── README.md           # 前端README
│   ├── index.html          # HTML入口
│   ├── package.json        # 依赖配置
│   └── vite.config.js      # Vite配置
└── README.md               # 项目根README
```

## 安装与运行

### 1. 环境要求
- PHP 7.4+
- MySQL 5.7+
- Node.js 16+
- NPM 7+

### 2. 后端安装
1. **配置数据库**
   - 打开 `backend/config/database.php` 文件
   - 修改数据库连接信息：
     ```php
     // 数据库连接信息
     $servername = "localhost";
     $username = "root";
     $password = "root";
     $dbname = "portfolio";
     ```

2. **创建数据库**
   - 在MySQL中创建名为 `portfolio` 的数据库
   - 导入数据库结构（如果需要）

3. **启动后端服务**
   
   ### 对于新手小白的详细部署步骤：
   
   #### 使用XAMPP（推荐，适合新手）
   1. **下载并安装XAMPP**
      - 访问 [XAMPP官网](https://www.apachefriends.org/index.html) 下载适合你系统的版本
      - 按照安装向导完成安装（默认安装即可）
   
   2. **配置项目**
      - 打开XAMPP安装目录（默认是 `C:\xampp`）
      - 找到 `htdocs` 文件夹
      - 将整个项目文件夹复制到 `htdocs` 目录中
      - 确保项目路径为：`C:\xampp\htdocs\myself`
   
   3. **启动服务**
      - 打开XAMPP控制面板
      - 点击 "Start" 按钮启动 "Apache" 和 "MySQL" 服务
      - 确保两个服务都显示为绿色状态
   
   4. **访问项目**
      - 打开浏览器，输入 `http://localhost/myself/backend/api.php`
      - 如果看到API响应（可能是一个错误消息，因为数据库还未配置），说明后端服务已成功部署
   
   #### 使用独立的Apache或Nginx服务器
   1. **安装服务器软件**
      - **Apache**：可以通过 [Apache官网](https://httpd.apache.org/download.cgi) 下载并安装
      - **Nginx**：可以通过 [Nginx官网](https://nginx.org/en/download.html) 下载并安装
   
   2. **配置虚拟主机**
      - **Apache**：编辑 `httpd-vhosts.conf` 文件，添加以下配置：
        ```
        <VirtualHost *:80>
            ServerName localhost
            DocumentRoot "C:/path/to/your/project/myself"
            <Directory "C:/path/to/your/project/myself">
                AllowOverride All
                Require all granted
            </Directory>
        </VirtualHost>
        ```
      
      - **Nginx**：编辑 `nginx.conf` 文件，添加以下配置：
        ```
        server {
            listen 80;
            server_name localhost;
            root C:/path/to/your/project/myself;
            index index.php index.html;
            
            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }
            
            location ~ \.php$ {
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
            }
        }
        ```
   
   3. **启动服务器**
      - 启动Apache或Nginx服务
   
   4. **访问项目**
      - 打开浏览器，输入 `http://localhost/backend/api.php`
      - 确保后端API可以正常访问

### 3. 前端安装
1. **安装依赖**
   ```bash
   cd myself-info
   npm install
   ```

2. **配置API地址**
   - 打开 `myself-info/src/services/api.js` 文件
   - 修改API基础URL：
     ```javascript
     const API_BASE_URL = 'http://localhost/backend/api.php';
     ```

3. **开发模式运行**
   ```bash
   npm run dev
   ```

4. **生产环境构建**
   ```bash
   npm run build
   ```

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

## 数据库结构

### 主要表结构

#### `personal_info` - 个人信息表
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

#### `skills` - 技能表
- `id` (INT, PRIMARY KEY)
- `name` (VARCHAR) - 技能名称
- `level` (VARCHAR) - 技能水平
- `category_id` (INT) - 技能分类ID
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

#### `skill_categories` - 技能分类表
- `id` (INT, PRIMARY KEY)
- `name` (VARCHAR) - 分类名称
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

#### `education` - 教育背景表
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

#### `experiences` - 工作经历表
- `id` (INT, PRIMARY KEY)
- `date` (VARCHAR) - 日期
- `title` (VARCHAR) - 职位
- `company` (VARCHAR) - 公司
- `description` (TEXT) - 描述
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

#### `projects` - 项目表
- `id` (INT, PRIMARY KEY)
- `title` (VARCHAR) - 项目标题
- `description` (TEXT) - 项目描述
- `technologies` (VARCHAR) - 使用技术
- `image` (VARCHAR) - 项目图片
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

#### `contact_info` - 联系方式表
- `id` (INT, PRIMARY KEY)
- `type` (VARCHAR) - 联系方式类型
- `value` (VARCHAR) - 联系方式值
- `icon` (VARCHAR) - 图标
- `created_at` (TIMESTAMP) - 创建时间
- `updated_at` (TIMESTAMP) - 更新时间

## 注意事项

1. **跨域问题**：后端API已配置CORS头，允许所有跨域请求
2. **数据库连接**：确保数据库连接信息正确配置
3. **API地址**：前端需要根据后端部署地址修改API基础URL
4. **权限控制**：当前API未实现权限控制，仅用于个人作品集展示
5. **数据安全**：生产环境中应添加适当的输入验证和安全措施

## 项目维护

- **前端**：使用Vite进行开发和构建
- **后端**：使用PHP原生代码实现API接口
- **数据库**：使用MySQL存储数据

## 作者信息

- **姓名**：陈洪伟
- **邮箱**：3485581538@qq.com
- **电话**：18929749359
- **大学**：桂林电子科技大学
- **专业**：数据科学与大数据

## 许可证

本项目仅供个人学习和展示使用，未经授权不得用于商业用途。