-- قاعدة بيانات نظام إدارة العقود
-- Contract Management System Database Schema

CREATE DATABASE IF NOT EXISTS contract_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE contract_management;

-- جدول المستخدمين
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client', 'viewer') DEFAULT 'viewer',
    full_name VARCHAR(100),
    phone VARCHAR(20),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- جدول الشركات
CREATE TABLE companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    legal_nature VARCHAR(100),
    establishment_place VARCHAR(100),
    registration_number VARCHAR(50),
    address TEXT,
    representative_name VARCHAR(100),
    representative_position VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    website VARCHAR(200),
    company_type ENUM('service_provider', 'client') NOT NULL,
    logo_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- جدول العقود
CREATE TABLE contracts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_number VARCHAR(50) UNIQUE NOT NULL,
    title VARCHAR(300) NOT NULL,
    description TEXT,
    service_provider_id INT NOT NULL,
    client_id INT NOT NULL,
    contract_date DATE NOT NULL,
    total_amount DECIMAL(15,2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'JOD',
    duration_weeks INT,
    status ENUM('draft', 'active', 'completed', 'cancelled') DEFAULT 'draft',
    created_by INT NOT NULL,
    contract_content LONGTEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_provider_id) REFERENCES companies(id) ON DELETE RESTRICT,
    FOREIGN KEY (client_id) REFERENCES companies(id) ON DELETE RESTRICT,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT
);

-- جدول مراحل المشروع
CREATE TABLE project_phases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT NOT NULL,
    phase_name VARCHAR(200) NOT NULL,
    duration_weeks INT,
    description TEXT,
    deliverables TEXT,
    start_date DATE,
    expected_end_date DATE,
    actual_end_date DATE,
    status ENUM('pending', 'in_progress', 'completed', 'delayed') DEFAULT 'pending',
    order_index INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE CASCADE
);

-- جدول مكونات التكلفة
CREATE TABLE cost_components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT NOT NULL,
    component_name VARCHAR(200) NOT NULL,
    cost_amount DECIMAL(15,2) NOT NULL,
    description TEXT,
    order_index INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE CASCADE
);

-- جدول الدفعات
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT NOT NULL,
    payment_name VARCHAR(200) NOT NULL,
    percentage DECIMAL(5,2),
    amount DECIMAL(15,2) NOT NULL,
    due_date DATE,
    payment_date DATE,
    status ENUM('pending', 'paid', 'overdue', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50),
    transaction_reference VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE CASCADE
);

-- جدول التوقيعات
CREATE TABLE signatures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT NOT NULL,
    signer_type ENUM('service_provider', 'client') NOT NULL,
    signer_name VARCHAR(100) NOT NULL,
    signer_email VARCHAR(100),
    signature_data LONGTEXT,
    signature_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('pending', 'signed') DEFAULT 'pending',
    verification_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE CASCADE
);

-- جدول مشاركة العقود
CREATE TABLE contract_shares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT NOT NULL,
    share_token VARCHAR(255) UNIQUE NOT NULL,
    recipient_email VARCHAR(100),
    recipient_name VARCHAR(100),
    access_type ENUM('view_only', 'sign_required') DEFAULT 'view_only',
    expires_at TIMESTAMP,
    accessed_at TIMESTAMP NULL,
    access_count INT DEFAULT 0,
    status ENUM('active', 'expired', 'used', 'revoked') DEFAULT 'active',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE RESTRICT
);

-- جدول سجل الأنشطة
CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT,
    user_id INT,
    action_type VARCHAR(50) NOT NULL,
    description TEXT,
    details JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (contract_id) REFERENCES contracts(id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- جدول إعدادات النظام
CREATE TABLE system_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    description TEXT,
    is_public BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- إدراج بيانات أولية
INSERT INTO users (username, email, password_hash, role, full_name) VALUES 
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'مدير النظام');

-- إدراج شركة مقدم الخدمة الافتراضية
INSERT INTO companies (name, legal_nature, establishment_place, email, phone, website, company_type) VALUES 
('شركة Strive Consulting LLC', 'شركة ذات مسؤولية محدودة', 'المملكة الأردنية الهاشمية', 'B.ahmed@consultstrive.com', '+962 79 0866 053', 'www.consultstrive.com', 'service_provider');

-- إدراج إعدادات النظام الافتراضية
INSERT INTO system_settings (setting_key, setting_value, setting_type, description, is_public) VALUES 
('site_name', 'نظام إدارة العقود', 'string', 'اسم الموقع', TRUE),
('default_currency', 'JOD', 'string', 'العملة الافتراضية', TRUE),
('contract_number_prefix', 'CON-', 'string', 'بادئة رقم العقد', FALSE),
('signature_expires_days', '30', 'number', 'مدة انتهاء صلاحية التوقيع بالأيام', FALSE),
('max_file_size', '10485760', 'number', 'الحد الأقصى لحجم الملف بالبايت (10MB)', FALSE);

-- إنشاء فهارس لتحسين الأداء
CREATE INDEX idx_contracts_status ON contracts(status);
CREATE INDEX idx_contracts_date ON contracts(contract_date);
CREATE INDEX idx_payments_status ON payments(status);
CREATE INDEX idx_payments_due_date ON payments(due_date);
CREATE INDEX idx_signatures_status ON signatures(status);
CREATE INDEX idx_contract_shares_token ON contract_shares(share_token);
CREATE INDEX idx_contract_shares_status ON contract_shares(status);
CREATE INDEX idx_activity_logs_date ON activity_logs(created_at);
CREATE INDEX idx_activity_logs_action ON activity_logs(action_type);