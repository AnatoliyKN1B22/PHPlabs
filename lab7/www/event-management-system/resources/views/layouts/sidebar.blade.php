<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <span class="brand-text font-weight-light">Event System</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Події</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Звіт</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('organizers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Організатори</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('participants.list') }}" class="nav-link"> {{-- Змінено на participants.list --}}
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Учасники (Глобально)</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>