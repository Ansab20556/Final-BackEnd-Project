-- My Database for this Project
CREATE DATABASE IF NOT EXISTS wfp_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


USE wfp_portal;

-- Users & Roles
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) COMMENT='System users with RBAC roles';

-- Organization (singleton row typically)
CREATE TABLE organization (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  logo VARCHAR(255),
  vision TEXT,
  mission TEXT,
  goals JSON,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) COMMENT='WFP org profile';

-- Volunteers
CREATE TABLE volunteers (
  volunteer_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  name VARCHAR(150) NOT NULL,
  contact_email VARCHAR(150),
  contact_phone VARCHAR(30),
  contact_address VARCHAR(255),
  approved TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_vol_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE volunteer_skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  volunteer_id INT NOT NULL,
  skill VARCHAR(100) NOT NULL,
  CONSTRAINT fk_vs_vol FOREIGN KEY (volunteer_id) REFERENCES volunteers(volunteer_id) ON DELETE CASCADE,
  INDEX(volunteer_id)
);

CREATE TABLE volunteer_interests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  volunteer_id INT NOT NULL,
  interest VARCHAR(100) NOT NULL,
  CONSTRAINT fk_vi_vol FOREIGN KEY (volunteer_id) REFERENCES volunteers(volunteer_id) ON DELETE CASCADE,
  INDEX(volunteer_id)
);

CREATE TABLE volunteer_availability (
  id INT AUTO_INCREMENT PRIMARY KEY,
  volunteer_id INT NOT NULL,
  available_date DATE NOT NULL,
  CONSTRAINT fk_va_vol FOREIGN KEY (volunteer_id) REFERENCES volunteers(volunteer_id) ON DELETE CASCADE,
  INDEX(volunteer_id, available_date)
);

-- Programs
CREATE TABLE programs (
  program_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  descrip TEXT,
  startt_date DATE,
  end_date DATE,
  typ VARCHAR(100),
  region VARCHAR(120),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE program_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  program_id INT NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  CONSTRAINT fk_pi_prog FOREIGN KEY (program_id) REFERENCES programs(program_id) ON DELETE CASCADE,
  INDEX(program_id)
);

-- Applications (volunteer registers to program)
CREATE TABLE volunteer_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  volunteer_id INT NOT NULL,
  program_id INT NOT NULL,
  status ENUM('pending','approved','rejected') DEFAULT 'pending',
  applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_app_vol FOREIGN KEY (volunteer_id) REFERENCES volunteers(volunteer_id) ON DELETE CASCADE,
  CONSTRAINT fk_app_prog FOREIGN KEY (program_id) REFERENCES programs(program_id) ON DELETE CASCADE,
  UNIQUE(volunteer_id, program_id)
);

-- Donations
CREATE TABLE donations (
  donation_id INT AUTO_INCREMENT PRIMARY KEY,
  donor_name VARCHAR(150) NOT NULL,
  donation_type ENUM('money','items') NOT NULL,
  amount DECIMAL(12,2) DEFAULT 0,
  item_description VARCHAR(255),
  donation_date DATE NOT NULL,
  confirmed TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Messages
CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
