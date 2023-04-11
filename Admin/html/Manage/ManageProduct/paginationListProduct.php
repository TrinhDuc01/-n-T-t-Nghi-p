<?php
function shorter($text, $chars_limit)
{
    if (strlen($text) > $chars_limit)
        return substr($text, 0, strrpos(substr($text, 0, $chars_limit), " ")) . '...';
    else
        return $text;
}
function pagination_List_Table($tenbang, $danhsachbangnoi, $thuoctinhkhoachinhnoi, $ma, $sodong, $tencot, $tenthuoctinh, $duongdan)
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
            //noi chuoi  de tao query noi bang
            $queryString = "SELECT * FROM {$tenbang}";
            foreach ($danhsachbangnoi as $key => $value) {
                $queryString = "{$queryString} INNER JOIN {$value} ON {$tenbang}.{$thuoctinhkhoachinhnoi[$key]} = {$value}.{$thuoctinhkhoachinhnoi[$key]}";
            }
            $queryString = "{$queryString} limit {$rowStart},{$pageSize}";
            // echo $queryString;
            $query = mysqli_query($connect, $queryString);
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
                        if ($value == 'product_image') {
                            echo "<td><img src="."../../../img/imgProduct/{$row[$value]}"."></td>";
                        } else {
                            echo "<td>" . shorter($row[$value], 50) . "</td>";
                        }

                    }
                    ?>
                    <td>
                        <a href="<?php echo $duongdan ?>.php?<?php echo 'e_id=' . $row[$ma]; ?>" class="btn-primary">
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