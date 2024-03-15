<style>
  .nav-custom {
    color: black !important;
  }
  .nav-custom:hover{
    color: #617a6b !important;
  }
  .active{
    color: #617a6b !important;
  }
</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link nav-custom" aria-current="page" href="/" id="btndashboard">
          <i class="bi bi-columns-gap"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-custom" href="/schedules" id="btnjadwal">
          <i class="bi bi-calendar3"></i>
          Jadwal Sewa
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-custom" href="/history" id="btnriwayat">
          <i class="bi bi-clock-history"></i>
          Riwayat Sewa
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-custom" href="/cars" id="btnmobil">
          <i class="bi bi-car-front"></i>
          Data Mobil
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-custom" href="/members" id="btnmember">
          <i class="bi bi-people"></i>
          Member
        </a>
      </li>
      {{-- <li class="nav-link">
        <form action="/logout" method="POST" class="text-left">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-box-arrow-left"></i>
            Logout
          </button>
        </form>
      </li> --}}
    </ul>
  </div>
</nav>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
