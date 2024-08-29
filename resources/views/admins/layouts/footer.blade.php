@php
    $generalsetting = \App\Models\Setting::first();
    $rolePermiss = \App\Models\Role::findOrFail(Auth::user()->role_id)->permissions;
@endphp
<footer class="footer">
    © 2022 {{ $generalsetting->st_name_site }}
    <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> CMD Solution</span>
</footer>
