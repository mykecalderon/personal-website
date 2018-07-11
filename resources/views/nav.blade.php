<nav class="shadow">
    <li class="nav-item {{ Request::path() == '/' ? 'active' : '' }}"><a href="/" class="nav-link">Home</a></li>
    <li class="nav-item {{ Request::path() == 'blog' ? 'active' : '' }}"><a href="/blog" class="nav-link">Blog</a></li>
    <li class="nav-item {{ Request::path() == 'contact' ? 'active' : '' }}"><a href="/contact" class="nav-link">Contact</a></li>
</nav>