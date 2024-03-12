<?php
function ngonci()
{
    $ci = &get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blok');
        }
    }
}
function ngacek($role_id, $menu_id)
{
    $edod = get_instance();

    $edod->db->where('role_id', $role_id);
    $edod->db->where('menu_id', $menu_id);
    $result = $edod->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
