<?php
require_once "vue/Vue.php";
class vueListeLivres extends Vue
{
    function affiche($json)
    {
        include "headerLivre.html";
        include "menu.php";
        include "listeLivres.html";
        echo ' <script type="text/javascript">
                var data=' . $json . ';
                $(function(){
                    //modif ça aussi
                    $(\'#dg\').datagrid({
                        data: data,
                        updateUrl: \'update_user.php\',
                        destroyUrl: \'destroy_user.php\'
                    });
                });
                function editUser() {
                    var row = $(\'#dg\').datagrid(\'getSelected\');
                    if (row) {
                        $(\'#dlg\').dialog(\'open\').dialog(\'center\').dialog(\'setTitle\', \'Edit User\');
                        $(\'#fm\').form(\'load\', row);
                        url = \'update_user.php?id=\' + row.id;
                    }
                }
                function saveUser() {
                    $(\'#fm\').form(\'submit\', {
                        data: data,
                        iframe: false,
                        onSubmit: function () {
                            return $(this).form(\'validate\');
                        },
                        success: function (result) {
                            var result = eval(\'(\' + result + \')\');
                            if (result.errorMsg) {
                                $.messager.show({
                                    title: \'Error\',
                                    msg: result.errorMsg
                                });
                            } else {
                                $(\'#dlg\').dialog(\'close\');       // close the dialog
                                $(\'#dg\').datagrid(\'reload\');    // reload the user data
                            }
                        }
                    });
                }
                function destroyUser() {
                    var row = $(\'#dg\').datagrid(\'getSelected\');
                    if (row) {
                        $.messager.confirm(\'Confirm\', \'Are you sure you want to destroy this user?\', function (r) {
                            if (r) {
                                $.post(\'destroy_user.php\', { id: row.id }, function (result) {
                                    if (result.success) {
                                        $(\'#dg\').datagrid(\'reload\');    // reload the user data
                                    } else {
                                        $.messager.show({    // show error message
                                            title: \'Error\',
                                            msg: result.errorMsg
                                        });
                                    }
                                }, \'json\');
                            }
                        });
                    }
                }
            </script>
        </div>
    </div>';

        include "footer.html";
    }
}