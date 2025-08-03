# Finance Tracker - Personal Finance Management System

A comprehensive personal finance tracking application built with Laravel, Livewire, and Bootstrap. Track your expenses, manage budgets, and achieve your financial goals with beautiful analytics and reports.

## 🚀 Features

### Core Features
- **Dashboard Analytics** - Overview of financial health with charts and metrics
- **Transaction Management** - Add, edit, and categorize income/expenses
- **Budget Management** - Set budgets and track spending against limits
- **Category Management** - Custom categories with colors and icons
- **Account Management** - Multiple accounts (Cash, Bank, Credit Cards)
- **Reports & Analytics** - Detailed financial reports and insights
- **Export Functionality** - Export data in PDF and Excel formats

### User Experience
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Modern UI/UX** - Clean, intuitive interface with Bootstrap 5
- **Real-time Updates** - Livewire components for dynamic interactions
- **Dark/Light Mode** - User preference for interface themes
- **Smart Notifications** - Budget alerts and bill reminders

### Security Features
- **User Authentication** - Secure login and registration system
- **Data Encryption** - Financial data is encrypted and secure
- **Session Management** - Secure session handling
- **CSRF Protection** - Built-in Laravel security features

## 🛠️ Technology Stack

- **Backend**: Laravel 12 + PHP 8.2
- **Frontend**: Livewire 3 + Alpine.js
- **Styling**: Bootstrap 5 + Custom CSS
- **Database**: MySQL/SQLite
- **Charts**: Chart.js
- **Icons**: Font Awesome 6
- **Fonts**: Google Fonts (Inter)

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL/SQLite
- Node.js & NPM (for asset compilation)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd LiveWireCrud
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   ```bash
   # Edit .env file with your database credentials
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=finance_tracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Compile assets (optional)**
   ```bash
   npm run dev
   ```

## 📱 Application Structure

### Database Tables
- `users` - User accounts and preferences
- `categories` - Transaction categories
- `accounts` - Financial accounts
- `transactions` - Income and expense records
- `budgets` - Budget settings and limits
- `savings_goals` - Financial goals tracking
- `bills` - Recurring bill management

### Key Pages
- **Dashboard** (`/dashboard`) - Financial overview and analytics
- **Transactions** (`/transactions`) - Manage income and expenses
- **Budgets** (`/budgets`) - Set and monitor budgets
- **Reports** (`/reports`) - Financial reports and insights
- **Accounts** (`/accounts`) - Manage financial accounts
- **Categories** (`/categories`) - Customize transaction categories
- **Settings** (`/settings`) - User preferences and account settings

## 🎨 Design System

### Color Palette
- **Primary**: Blue (#3B82F6)
- **Secondary**: Green (#10B981)
- **Accent**: Purple (#8B5CF6)
- **Warning**: Orange (#F59E0B)
- **Danger**: Red (#EF4444)
- **Success**: Green (#10B981)

### Typography
- **Font Family**: Inter (Google Fonts)
- **Weights**: 300, 400, 500, 600, 700

## 🔧 Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Database Seeding
```bash
php artisan db:seed
```

## 📊 Features in Detail

### Dashboard
- Monthly income vs expenses overview
- Category-wise spending breakdown
- Budget progress tracking
- Recent transactions list
- Quick add transaction functionality

### Transaction Management
- Add income and expenses
- Categorize transactions
- Multiple account support
- Date and description tracking
- Bulk operations support

### Budget System
- Set monthly budgets per category
- Real-time budget tracking
- Budget alerts and notifications
- Budget vs actual comparisons

### Reports & Analytics
- Monthly and yearly summaries
- Category analysis
- Spending trends
- Export functionality (PDF/Excel)
- Custom date range reports

## 🔒 Security

- User authentication with Laravel's built-in features
- CSRF protection on all forms
- SQL injection prevention
- XSS protection
- Secure password hashing
- Session security

## 📱 Mobile Responsiveness

The application is fully responsive and optimized for:
- Desktop computers
- Tablets
- Mobile phones
- Touch interfaces

## 🚀 Deployment

### Production Setup
1. Set environment to production
2. Optimize Laravel for production
3. Configure web server (Apache/Nginx)
4. Set up SSL certificate
5. Configure database for production
6. Set up backup system

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🆘 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 🎯 Roadmap

### Phase 2 Features
- [ ] Multi-currency support
- [ ] Bill reminders and automation
- [ ] Investment tracking
- [ ] Debt management
- [ ] Financial goals with progress tracking
- [ ] Mobile app (React Native)

### Phase 3 Features
- [ ] Bank account integration
- [ ] Receipt scanning with OCR
- [ ] AI-powered spending insights
- [ ] Family/shared accounts
- [ ] Advanced reporting and forecasting
- [ ] API for third-party integrations

---

**Built with ❤️ using Laravel and Livewire**
