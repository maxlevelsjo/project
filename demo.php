<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة العقود الإلكترونية - عرض تجريبي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .demo-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .hero-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin-bottom: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
        
        .btn-demo {
            background: #3498db;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-demo:hover {
            background: #2980b9;
            color: white;
            transform: translateY(-2px);
        }
        
        .screenshot {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin: 1rem 0;
        }
        
        .stats-section {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            color: white;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #f39c12;
        }
        
        .stat-label {
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="demo-container">
        <!-- القسم الرئيسي -->
        <div class="hero-section">
            <h1 class="display-4 mb-4">
                <i class="fas fa-file-contract text-primary"></i>
                نظام إدارة العقود الإلكترونية
            </h1>
            <p class="lead mb-4">
                نظام متكامل وحديث لإدارة العقود مع التوقيع الإلكتروني والمشاركة الآمنة
            </p>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">آمن ومشفر</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">متاح دائماً</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">∞</div>
                        <div class="stat-label">عقود غير محدودة</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- إحصائيات النظام -->
        <div class="stats-section">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">9</div>
                        <div class="stat-label">جداول قاعدة بيانات</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">صفحة ووظيفة</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">5</div>
                        <div class="stat-label">مستويات أمان</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">متجاوب</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- المزايا الرئيسية -->
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-signature"></i>
                    </div>
                    <h4>التوقيع الإلكتروني</h4>
                    <p>نظام توقيع إلكتروني متقدم مع حفظ آمن للتوقيعات وتسجيل تاريخ ووقت التوقيع</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success"></i> رسم التوقيع بالماوس أو اللمس</li>
                        <li><i class="fas fa-check text-success"></i> حفظ آمن ومشفر</li>
                        <li><i class="fas fa-check text-success"></i> تسجيل IP والوقت</li>
                        <li><i class="fas fa-check text-success"></i> قوة قانونية كاملة</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h4>مشاركة العقود</h4>
                    <p>إنشاء روابط مشاركة آمنة مع صلاحيات متنوعة وانتهاء صلاحية قابل للتخصيص</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success"></i> روابط آمنة ومشفرة</li>
                        <li><i class="fas fa-check text-success"></i> صلاحيات متدرجة</li>
                        <li><i class="fas fa-check text-success"></i> انتهاء صلاحية تلقائي</li>
                        <li><i class="fas fa-check text-success"></i> تتبع الوصول</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h4>تحميل PDF</h4>
                    <p>تحويل العقود إلى ملفات PDF احترافية مع التوقيعات والتصميم المتقن</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success"></i> تصميم احترافي</li>
                        <li><i class="fas fa-check text-success"></i> تضمين التوقيعات</li>
                        <li><i class="fas fa-check text-success"></i> معلومات كاملة</li>
                        <li><i class="fas fa-check text-success"></i> جاهز للطباعة</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- المزايا الإضافية -->
        <div class="row">
            <div class="col-md-6">
                <div class="feature-card">
                    <h4>
                        <i class="fas fa-shield-alt text-primary"></i>
                        الأمان والحماية
                    </h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> تشفير كلمات المرور</li>
                        <li><i class="fas fa-check text-success"></i> حماية CSRF</li>
                        <li><i class="fas fa-check text-success"></i> جلسات آمنة</li>
                        <li><i class="fas fa-check text-success"></i> تسجيل العمليات</li>
                        <li><i class="fas fa-check text-success"></i> صلاحيات متدرجة</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="feature-card">
                    <h4>
                        <i class="fas fa-cogs text-primary"></i>
                        إدارة متقدمة
                    </h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> لوحة تحكم شاملة</li>
                        <li><i class="fas fa-check text-success"></i> إدارة الشركات</li>
                        <li><i class="fas fa-check text-success"></i> إدارة المستخدمين</li>
                        <li><i class="fas fa-check text-success"></i> تقارير مفصلة</li>
                        <li><i class="fas fa-check text-success"></i> بحث وتصفية متقدم</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- هيكل قاعدة البيانات -->
        <div class="feature-card">
            <h3 class="text-center mb-4">
                <i class="fas fa-database text-primary"></i>
                هيكل قاعدة البيانات المتقدم
            </h3>
            <div class="row">
                <div class="col-md-3">
                    <h5>الجداول الأساسية</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-table text-info"></i> users</li>
                        <li><i class="fas fa-table text-info"></i> companies</li>
                        <li><i class="fas fa-table text-info"></i> contracts</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>جداول التفاصيل</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-table text-warning"></i> contract_phases</li>
                        <li><i class="fas fa-table text-warning"></i> cost_components</li>
                        <li><i class="fas fa-table text-warning"></i> payment_schedule</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>جداول التفاعل</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-table text-success"></i> signatures</li>
                        <li><i class="fas fa-table text-success"></i> contract_shares</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>جداول النظام</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-table text-danger"></i> activity_logs</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- الملفات والمكونات -->
        <div class="feature-card">
            <h3 class="text-center mb-4">
                <i class="fas fa-folder-open text-primary"></i>
                مكونات النظام
            </h3>
            <div class="row">
                <div class="col-md-4">
                    <h5>الملفات الأساسية</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-file-code text-primary"></i> index.php</li>
                        <li><i class="fas fa-file-code text-primary"></i> login.php</li>
                        <li><i class="fas fa-file-code text-primary"></i> setup.php</li>
                        <li><i class="fas fa-file-code text-primary"></i> install.php</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>صفحات الإدارة</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-file-alt text-success"></i> contracts.php</li>
                        <li><i class="fas fa-file-alt text-success"></i> contract_form.php</li>
                        <li><i class="fas fa-file-alt text-success"></i> contract_sign.php</li>
                        <li><i class="fas fa-file-alt text-success"></i> contract_share.php</li>
                        <li><i class="fas fa-file-alt text-success"></i> companies.php</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>المكونات التقنية</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-cog text-warning"></i> Database.php</li>
                        <li><i class="fas fa-cog text-warning"></i> Contract.php</li>
                        <li><i class="fas fa-cog text-warning"></i> User.php</li>
                        <li><i class="fas fa-cog text-warning"></i> functions.php</li>
                        <li><i class="fas fa-cog text-warning"></i> autoload.php</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- التقنيات المستخدمة -->
        <div class="feature-card">
            <h3 class="text-center mb-4">
                <i class="fas fa-code text-primary"></i>
                التقنيات المستخدمة
            </h3>
            <div class="row text-center">
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fab fa-php fa-3x text-primary mb-2"></i>
                        <h6>PHP 8.1+</h6>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fas fa-database fa-3x text-success mb-2"></i>
                        <h6>MySQL/SQLite</h6>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fab fa-html5 fa-3x text-danger mb-2"></i>
                        <h6>HTML5</h6>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fab fa-css3-alt fa-3x text-info mb-2"></i>
                        <h6>CSS3</h6>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fab fa-js-square fa-3x text-warning mb-2"></i>
                        <h6>JavaScript</h6>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="tech-item">
                        <i class="fab fa-bootstrap fa-3x text-purple mb-2"></i>
                        <h6>Bootstrap</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- معلومات التطوير -->
        <div class="feature-card text-center">
            <h3 class="mb-4">
                <i class="fas fa-info-circle text-primary"></i>
                معلومات المشروع
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <h5>الإحصائيات</h5>
                    <ul class="list-unstyled">
                        <li><strong>عدد الملفات:</strong> 20+ ملف</li>
                        <li><strong>أسطر الكود:</strong> 3000+ سطر</li>
                        <li><strong>الوقت المطلوب:</strong> 6 مراحل تطوير</li>
                        <li><strong>المزايا:</strong> 15+ ميزة متقدمة</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>المتطلبات</h5>
                    <ul class="list-unstyled">
                        <li><strong>PHP:</strong> 7.4 أو أحدث</li>
                        <li><strong>قاعدة البيانات:</strong> MySQL/SQLite</li>
                        <li><strong>الخادم:</strong> Apache/Nginx</li>
                        <li><strong>المتصفح:</strong> حديث ومتجاوب</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- تذييل -->
        <div class="text-center text-white mt-5">
            <h4>🎉 تم إنجاز المشروع بنجاح! 🎉</h4>
            <p class="lead">نظام إدارة العقود الإلكترونية جاهز للاستخدام مع جميع المزايا المطلوبة</p>
            <div class="mt-4">
                <a href="README.md" class="btn-demo">
                    <i class="fas fa-book"></i>
                    دليل الاستخدام
                </a>
                <a href="install.php" class="btn-demo">
                    <i class="fas fa-download"></i>
                    بدء التثبيت
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

