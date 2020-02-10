<template>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Examen Juan Pablo</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Modulos</p>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Prospectos</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="/prospectos">Listado</a>
                </li>
                <li>
                    <a href="/prospectos/create">Crear</a>
                </li>

            </ul>
        </li>
    </ul>
</nav>

</template>
