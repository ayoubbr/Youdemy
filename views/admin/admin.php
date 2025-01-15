<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Learning Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            /* Primary Colors */
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;

            /* Secondary Colors */
            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;

            /* Background Gradients */
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --card-gradient: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));

            /* Neutral Colors */
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;

            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: var(--white);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--text-color);
        }

        .add-new-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
        }

        .add-new-btn:hover {
            background: var(--primary-dark);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .card-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            color: #10b981;
        }

        /* Table Styles */
        .data-table {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        th {
            background: var(--background-color);
            font-weight: 600;
            color: var(--text-light);
        }

        td {
            color: var(--text-color);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background: #dbeafe;
            color: #1e40af;
        }

        .delete-btn {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 1rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .modal-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .cancel-btn {
            background: var(--background-color);
            color: var(--text-color);
        }

        .save-btn {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Keeping the root styles and basic setup from previous dashboard */
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
        }

        /* Course Management Specific Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            color: var(--text-color);
        }

        .course-filters {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .filter-group input,
        .filter-group select {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .course-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .course-image {
            height: 160px;
            background: var(--bg-gradient);
            position: relative;
        }

        .course-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-published {
            background: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background: #fef9c3;
            color: #854d0e;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-category {
            font-size: 0.75rem;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .course-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .course-instructor {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .course-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .course-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .action-button {
            flex: 1;
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
        }

        .edit-button {
            background: #dbeafe;
            color: #1e40af;
        }

        .delete-button {
            background: #fee2e2;
            color: #991b1b;
        }

        .add-course-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            transition: background-color 0.2s;
        }

        .add-course-btn:hover {
            background: var(--primary-dark);
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-button {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: var(--white);
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-button.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .page-button:hover:not(.active) {
            background: #f8fafc;
        }

        /* Section Title */
        .section-title {
            display: flex;
            align-items: center;
            margin: 30px 0 20px;
        }

        .section-title h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .count-badge {
            background: #e5e7eb;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.875rem;
            color: #6b7280;
            margin-left: 10px;
        }

        /* Category and Tag Styles */
        .category-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .category-icon {
            width: 36px;
            height: 36px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
        }

        .category-name {
            font-weight: 500;
        }

        .tag-name {
            font-weight: 500;
            color: #111827;
        }

        /* Header Actions */
        .header-actions {
            display: flex;
            gap: 12px;
        }

        /* Form Textarea */
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 80px;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Main Layout */
        .main-content {
            padding: 24px;
            background-color: #f9fafb;
            min-height: 100vh;
        }

        /* Page Header Enhancements */
        .page-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        /* Enhanced Button Styles */
        .add-user-btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .add-user-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
        }

        .page-button {
            background: white;
            border: 1px solid #d1d5db;
            padding: 8px 16px;
            border-radius: 6px;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .page-button:hover {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        /* Filter Section Improvements */
        .user-filters {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #111827;
            transition: all 0.2s ease;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        /* Table Enhancements */
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            background: #f9fafb;
            padding: 12px 16px;
            text-align: left;
            font-weight: 500;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        .users-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #111827;
        }

        .users-table tbody tr:hover {
            background: #f9fafb;
        }

        /* Status Badge Improvements */
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Action Menu Refinements */
        .action-menu {
            position: relative;
        }

        .action-button {
            background: none;
            border: none;
            padding: 6px;
            cursor: pointer;
            color: #6b7280;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .action-button:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            min-width: 160px;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.2s ease;
        }

        .action-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .action-item {
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-item:hover {
            background: #f3f4f6;
        }

        .action-item.delete {
            color: #dc2626;
        }

        .action-item.delete:hover {
            background: #fee2e2;
        }

        /* Pagination Improvements */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .pagination-buttons {
            display: flex;
            gap: 4px;
        }

        .pagination-buttons .page-button {
            min-width: 36px;
            height: 36px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-buttons .page-button.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Loading States */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f4f6;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .header-actions {
                flex-direction: column;
                gap: 8px;
            }

            .pagination {
                flex-direction: column;
                gap: 16px;
                align-items: center;
            }

            .table-container {
                overflow-x: auto;
            }

            .users-table {
                min-width: 600px;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            color: #d1d5db;
        }

        /* Success Message */
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #059669;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .success-message.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Hover Effects */
        .category-icon:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }

        .tag-name:hover {
            color: #3b82f6;
            cursor: pointer;
        }

        /* Modal Base Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Modal Header */
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .modal-header h2 {
            margin: 0;
            color: #333;
            font-size: 1.5rem;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            padding: 5px 10px;
        }

        .modal-close:hover {
            color: #333;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .page-button {
            padding: 8px 16px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            color: #333;
        }

        .add-user-btn {
            padding: 8px 16px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .page-button:hover {
            background-color: #eee;
        }

        .add-user-btn:hover {
            background-color: #357abd;
        }

        /* Show Modal (add this class when opening the modal) */
        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);

            /* Status colors */
            --status-active: #16a34a;
            --status-suspended: #dc2626;
            --status-pending: #ca8a04;
            --status-active-bg: #dcfce7;
            --status-suspended-bg: #fee2e2;
            --status-pending-bg: #fef9c3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
        }

        .main-content {
            padding: 2rem;
        }

        /* Header Styles */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            color: var(--text-color);
        }

        .add-user-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
        }

        .add-user-btn:hover {
            background: var(--primary-dark);
        }

        /* Filter Section */
        .user-filters {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .filter-group input,
        .filter-group select {
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }

        /* Users Table */
        .users-table-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .users-table th {
            background: var(--background-color);
            font-weight: 600;
            color: var(--text-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 500;
        }

        .user-email {
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            text-align: center;
            display: inline-block;
        }

        .status-active {
            background: var(--status-active-bg);
            color: var(--status-active);
        }

        .status-suspended {
            background: var(--status-suspended-bg);
            color: var(--status-suspended);
        }

        .status-pending {
            background: var(--status-pending-bg);
            color: var(--status-pending);
        }

        .action-menu {
            position: relative;
        }

        .action-button {
            background: none;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            background: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 160px;
            z-index: 10;
            display: none;
        }

        .action-dropdown.active {
            display: block;
        }

        .action-item {
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-color);
            text-decoration: none;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .action-item:hover {
            background: var(--background-color);
        }

        .action-item.delete {
            color: var(--status-suspended);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding: 1rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .pagination-info {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .pagination-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .page-button {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: var(--white);
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-button.active {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        /* Modal Base Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        /* Modal Header */
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6b7280;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.2s ease;
        }

        .modal-close:hover {
            color: #111827;
        }

        /* Form Styles */
        .modal form {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Form Actions */
        .form-actions {
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        /* Error Message Styles */
        .error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ef4444;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .error-message.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Modal Animation */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .modal-content {
                width: 95%;
                margin: 10px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    $request = $_SERVER['REQUEST_URI'];
    ?>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            Admin Panel
        </div>
        <nav>
            <a href="/admin" class="nav-item <?php echo $request == '/admin' ?  'active' :  ''; ?>">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            <a href="/admin/courses" class="nav-item <?php echo $request == '/admin/courses' ?  'active' :  ''; ?>">
                <i class="fas fa-book"></i>
                Courses
            </a>
            <a href="/admin/users" class="nav-item <?php echo $request == '/admin/users' ?  'active' :  ''; ?>">
                <i class="fas fa-users"></i>
                Users
            </a>
            <a href="/admin/topics" class="nav-item <?php echo $request == '/admin/topics   ' ?  'active' :  ''; ?>">
                <i class="fas fa-tags"></i>
                Categories & Tags
            </a>
            <!-- <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                Settings
            </a> -->
        </nav>
    </aside>

    <?php

    switch ($request) {

        case '/admin/courses':
            require __DIR__ . "\\courses.php";
            break;
        case '/admin/users':
            require __DIR__ . "\\users.php";
            break;
        case '/admin/topics':
            require __DIR__ . "\\topics.php";
            break;
        case '/admin':
        default:
            include __DIR__ . "\\dashboard.php";
            break;
    }

    ?>

</body>

</html>