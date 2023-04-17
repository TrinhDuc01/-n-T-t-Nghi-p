<?php

function pagination_List_Table($tenbang, $ma, $sodong, $tencot, $tenthuoctinh,$duongdan)
{
    $username = "root"; // Khai báo username
    $password = ""; // Khai báo password
    $server = "localhost"; // Khai báo server
    $dbname = "noithatbinhminh"; // Khai báo database
    // Kết nối database tintuc
    $connect = new mysqli($server, $username, $password, $dbname);

    $queryRows = mysqli_query($connect, "SELECT * FROM " . $tenbang);
    $totalRows = mysqli_num_rows($queryRows);
    $pageSize = $sodong; // số dòng tối đa trong 1 trang
    $totalPage = 1; // tính  tổng số trang

    // print_r($tencot);

    if ($totalRows % $pageSize == 0) {
        $totalPage = $totalRows / $pageSize;
    } else {
        $totalPage = (int) ($totalRows / $pageSize) + 1;
    }
    $rowStart = 1;
    $pageCurrent = 1;

    if ((!isset($_GET['page'])) || ($_GET['page'] == 1)) {
        $rowStart = 0;
        $pageCurrent = 1;
    } else {
        $rowStart = ($_GET['page'] - 1) * $pageSize;
        $pageCurrent = $_GET['page'];
    }

    ?>
    <table>
        <thead>
            <tr>
                <?php
                foreach ($tencot as $key => $value) {
                    echo "<th>" . $value . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = mysqli_query($connect, "SELECT * FROM {$tenbang} limit {$rowStart},{$pageSize}");
            $stt = 0;
            while ($row = mysqli_fetch_array($query)) {
                $stt++;
                ?>
                <tr>
                    <th>
                        <?php echo $stt; ?>
                    </th>
                    <?php
                    foreach ($tenthuoctinh as $key => $value) {
                        echo "<td>".$row[$value]."</td>";
                    }
                    ?>
                    <td>
                        <a href="<?php echo $duongdan ?>.php?<?php echo 'id=' . $row[$ma]; ?>" class="btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a onclick="if(ConfirmDelete()==0) return false" href="?<?php echo 'id=' . $row[$ma]; ?>"
                            class="btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    Trang: <?php echo isset($_REQUEST['page'])? $_REQUEST['page']: 1?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($pageCurrent == $i) {
                echo "<a>" . $i . "</a>";
            } else {
                ?>
                <a href="?page=<?php echo $i; ?>"><?php echo $i . ' '; ?></a>
                <?php
            }
        }
        ?>
    </div>
    <?php
}
?>