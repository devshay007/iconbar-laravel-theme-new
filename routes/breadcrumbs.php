<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('home'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', url('admin/dashboard'));
});

Breadcrumbs::macro('resource', function ($name, $title){
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('home');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('Add', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model,$ex) use ($name) {
    	$trail->parent("$name.index");
        $trail->push($ex, route("$name.show", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model,$ex) use ($name) {
    	$trail->parent("$name.show", $model,$ex);
        $trail->push('Edit', route("$name.edit", $model));
    });
});

Breadcrumbs::resource('admin.roles', 'Roles');
Breadcrumbs::resource('admin.users', 'Users');