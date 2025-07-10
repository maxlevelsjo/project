<?php
/**
 * ملف تثبيت وإعداد نظام إدارة العقود
 * Contract Management System Installation
 */

// إعدادات قاعدة البيانات
$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'dyangthh_contract',
    'username' => 'dyangthh_contract',
    'password' => 'New123@yahoo',
    'charset' => 'utf8mb4'
];

// إعدادات النظام
$systemConfig = [
    'site_name' => 'نظام إدارة العقود الإلكترونية',
    'admin_email' => 'admin@admin.com',
    'admin_password' => 'admin123',
    'timezone' => 'Asia/Amman'
];

$step = $_GET['step'] ?? 1;
$error = '';
$success = '';

// معالجة خطوات التثبيت
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($step) {
        case 1:
            // اختبار الاتصال بقاعدة البيانات
            try {
                $pdo = new PDO(
                    "mysql:host={$dbConfig['host']};charset={$dbConfig['charset']}", 
                    $dbConfig['username'], 
                    $dbConfig['password']
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // إنشاء قاعدة البيانات
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbConfig['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                
                $success = 'تم إنشاء قاعدة البيانات بنجاح';
                $step = 2;
            } catch (PDOException $e) {
                $error = 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage();
            }
            break;
            
        case 2:
            // إنشاء الجداول
            try {
                $pdo = new PDO(
                    "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}", 
                    $dbConfig['username'], 
                    $dbConfig['password']
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // قراءة ملف SQL
                $sql = file_get_contents('database/schema.sql');
                
                // تنفيذ الاستعلامات
                $statements = explode(';', $sql);
                foreach ($statements as $statement) {
                    $statement = trim($statement);
                    if (!empty($statement)) {
                        $pdo->exec($statement);
                    }
                }
                
                $success = 'تم إنشاء جداول قاعدة البيانات بنجاح';
                $step = 3;
            } catch (PDOException $e) {
                $error = 'خطأ في إنشاء الجداول: ' . $e->getMessage();
            }
            break;
            
        case 3:
            // إنشاء المستخدم الإداري
            try {
                $pdo = new PDO(
                    "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}", 
                    $dbConfig['username'], 
                    $dbConfig['password']
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // إنشاء المستخدم الإداري
                $hashedPassword = password_hash($systemConfig['admin_password'], PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("
                    INSERT INTO users (username, email, password, full_name, role, status, created_at) 
                    VALUES (?, ?, ?, ?, 'admin', 'active', NOW())
                ");
                $stmt->execute([
                    'admin',
                    $systemConfig['admin_email'],
                    $hashedPassword,
                    'مدير النظام'
                ]);
                
                // إنشاء ملف الإعدادات
                $configContent = "<?php\n";
                $configContent .= "// إعدادات النظام\n";
                $configContent .= "define('DB_HOST', '{$dbConfig['host']}');\n";
                $configContent .= "define('DB_NAME', '{$dbConfig['dbname']}');\n";
                $configContent .= "define('DB_USER', '{$dbConfig['username']}');\n";
                $configContent .= "define('DB_PASS', '{$dbConfig['password']}');\n";
                $configContent .= "define('DB_CHARSET', '{$dbConfig['charset']}');\n\n";
                $configContent .= "define('SITE_NAME', '{$systemConfig['site_name']}');\n";
                $configContent .= "define('ADMIN_EMAIL', '{$systemConfig['admin_email']}');\n";
                $configContent .= "define('TIMEZONE', '{$systemConfig['timezone']}');\n\n";
                $configContent .= "// مفاتيح الأمان\n";
                $configContent .= "define('SECRET_KEY', '" . bin2hex(random_bytes(32)) . "');\n";
                $configContent .= "define('CSRF_SECRET', '" . bin2hex(random_bytes(16)) . "');\n\n";
                $configContent .= "// إعدادات الجلسة\n";
                $configContent .= "ini_set('session.cookie_httponly', 1);\n";
                $configContent .= "ini_set('session.use_only_cookies', 1);\n";
                $configContent .= "ini_set('session.cookie_secure', 0); // تغيير إلى 1 في HTTPS\n\n";
                $configContent .= "// تعيين المنطقة الزمنية\n";
                $configContent .= "date_default_timezone_set(TIMEZONE);\n";
                
                file_put_contents('config/config.php', $configContent);
                
                $success = 'تم إنشاء المستخدم الإداري وملف الإعدادات بنجاح';
                $step = 4;
            } catch (PDOException $e) {
                $error = 'خطأ في إنشاء المستخدم الإداري: ' . $e->getMessage();
            }
            break;
            
        case 4:
            // إنشاء بيانات تجريبية
            try {
                $pdo = new PDO(
                    "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}", 
                    $dbConfig['username'], 
                    $dbConfig['password']
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // إنشاء شركات تجريبية
                $companies = [
                    ['شركة التقنية المتقدمة', 'service_provider', 'info@techadvanced.com', '+966501234567'],
                    ['مؤسسة الأعمال الرقمية', 'client', 'contact@digitalbusiness.com', '+966507654321'],
                    ['شركة الحلول الذكية', 'both', 'hello@smartsolutions.com', '+966509876543']
                ];
                
                foreach ($companies as $company) {
                    $stmt = $pdo->prepare("
                        INSERT INTO companies (name, type, email, phone, created_at) 
                        VALUES (?, ?, ?, ?, NOW())
                    ");
                    $stmt->execute($company);
                }
                
                // إنشاء عقد تجريبي
                $stmt = $pdo->prepare("
                    INSERT INTO contracts (
                        contract_number, title, service_provider_id, client_id, 
                        contract_date, total_amount, currency, duration_weeks,
                        description, status, created_at
                    ) VALUES (
                        'CNT-2024-001', 'تطوير موقع إلكتروني متكامل', 1, 2,
                        CURDATE(), 15000.00, 'SAR', 8,
                        'تطوير موقع إلكتروني متكامل مع لوحة تحكم إدارية ونظام إدارة المحتوى',
                        'active', NOW()
                    )
                ");
                $stmt->execute();
                
                $success = 'تم إنشاء البيانات التجريبية بنجاح';
                $step = 5;
            } catch (PDOException $e) {
                $error = 'خطأ في إنشاء البيانات التجريبية: ' . $e->getMessage();
            }
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تثبيت نظام إدارة العقود</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .install-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .install-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .install-header {
            background: #2c3e50;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .install-body {
            padding: 2rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            font-weight: bold;
            position: relative;
        }
        
        .step.active {
            background: #3498db;
            color: white;
        }
        
        .step.completed {
            background: #27ae60;
            color: white;
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -20px;
            width: 20px;
            height: 2px;
            background: #e9ecef;
            transform: translateY(-50%);
        }
        
        .step.completed:not(:last-child)::after {
            background: #27ae60;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .btn {
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .feature-list li:last-child {
            border-bottom: none;
        }
        
        .feature-list i {
            color: #27ae60;
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-card">
            <div class="install-header">
                <h1>
                    <i class="fas fa-file-contract"></i>
                    نظام إدارة العقود الإلكترونية
                </h1>
                <p class="mb-0">مرحباً بك في معالج التثبيت</p>
            </div>
            
            <div class="install-body">
                <!-- مؤشر الخطوات -->
                <div class="step-indicator">
                    <div class="step <?php echo $step >= 1 ? ($step > 1 ? 'completed' : 'active') : ''; ?>">1</div>
                    <div class="step <?php echo $step >= 2 ? ($step > 2 ? 'completed' : 'active') : ''; ?>">2</div>
                    <div class="step <?php echo $step >= 3 ? ($step > 3 ? 'completed' : 'active') : ''; ?>">3</div>
                    <div class="step <?php echo $step >= 4 ? ($step > 4 ? 'completed' : 'active') : ''; ?>">4</div>
                    <div class="step <?php echo $step >= 5 ? 'active' : ''; ?>">5</div>
                </div>
                
                <!-- عرض الرسائل -->
                <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                </div>
                <?php endif; ?>
                
                <!-- محتوى الخطوات -->
                <?php if ($step == 1): ?>
                <div class="text-center">
                    <h3>مرحباً بك في نظام إدارة العقود</h3>
                    <p class="text-muted mb-4">نظام متكامل لإدارة العقود الإلكترونية مع التوقيع الرقمي</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5>المزايا الرئيسية:</h5>
                            <ul class="feature-list text-start">
                                <li><i class="fas fa-check"></i> إدارة شاملة للعقود والشركات</li>
                                <li><i class="fas fa-check"></i> التوقيع الإلكتروني الآمن</li>
                                <li><i class="fas fa-check"></i> مشاركة العقود مع العملاء</li>
                                <li><i class="fas fa-check"></i> تحميل العقود كملفات PDF</li>
                                <li><i class="fas fa-check"></i> لوحة تحكم إدارية متقدمة</li>
                                <li><i class="fas fa-check"></i> نظام أمان متطور</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>المتطلبات:</h5>
                            <ul class="feature-list text-start">
                                <li><i class="fas fa-server"></i> PHP 7.4 أو أحدث</li>
                                <li><i class="fas fa-database"></i> MySQL 5.7 أو أحدث</li>
                                <li><i class="fas fa-globe"></i> خادم ويب (Apache/Nginx)</li>
                                <li><i class="fas fa-folder"></i> مساحة تخزين كافية</li>
                                <li><i class="fas fa-shield-alt"></i> SSL (مستحسن)</li>
                            </ul>
                        </div>
                    </div>
                    
                    <form method="POST" action="?step=1">
                        <button type="submit" class="btn btn-primary btn-lg mt-4">
                            <i class="fas fa-play"></i>
                            بدء التثبيت
                        </button>
                    </form>
                </div>
                
                <?php elseif ($step == 2): ?>
                <div class="text-center">
                    <h3>إنشاء جداول قاعدة البيانات</h3>
                    <p class="text-muted">سيتم إنشاء جميع الجداول المطلوبة لتشغيل النظام</p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        سيتم إنشاء 9 جداول رئيسية تشمل العقود والشركات والمستخدمين والتوقيعات
                    </div>
                    
                    <form method="POST" action="?step=2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-database"></i>
                            إنشاء الجداول
                        </button>
                    </form>
                </div>
                
                <?php elseif ($step == 3): ?>
                <div class="text-center">
                    <h3>إنشاء المستخدم الإداري</h3>
                    <p class="text-muted">سيتم إنشاء حساب المدير الرئيسي للنظام</p>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-user-shield"></i>
                        <strong>بيانات تسجيل الدخول:</strong><br>
                        اسم المستخدم: <code>admin</code><br>
                        كلمة المرور: <code>admin123</code><br>
                        <small>يرجى تغيير كلمة المرور بعد تسجيل الدخول</small>
                    </div>
                    
                    <form method="POST" action="?step=3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i>
                            إنشاء المستخدم الإداري
                        </button>
                    </form>
                </div>
                
                <?php elseif ($step == 4): ?>
                <div class="text-center">
                    <h3>إنشاء البيانات التجريبية</h3>
                    <p class="text-muted">سيتم إنشاء بيانات تجريبية لتسهيل اختبار النظام</p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-flask"></i>
                        سيتم إنشاء 3 شركات تجريبية وعقد نموذجي لاختبار جميع المزايا
                    </div>
                    
                    <form method="POST" action="?step=4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i>
                            إنشاء البيانات التجريبية
                        </button>
                        <a href="?step=5" class="btn btn-outline-secondary">
                            <i class="fas fa-skip-forward"></i>
                            تخطي هذه الخطوة
                        </a>
                    </form>
                </div>
                
                <?php else: ?>
                <div class="text-center">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h3>تم التثبيت بنجاح!</h3>
                        <p>نظام إدارة العقود جاهز للاستخدام</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-sign-in-alt text-primary"></i>
                                        تسجيل الدخول
                                    </h5>
                                    <p class="card-text">ادخل إلى لوحة التحكم الإدارية</p>
                                    <a href="login.php" class="btn btn-primary">
                                        دخول النظام
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-book text-info"></i>
                                        التوثيق
                                    </h5>
                                    <p class="card-text">اقرأ دليل الاستخدام</p>
                                    <a href="README.md" class="btn btn-info">
                                        عرض التوثيق
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning mt-4">
                        <i class="fas fa-shield-alt"></i>
                        <strong>تنبيه أمني:</strong> يرجى حذف ملف <code>install.php</code> بعد اكتمال التثبيت لأسباب أمنية.
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

