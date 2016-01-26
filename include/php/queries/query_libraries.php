<?php
    function all_libraries($db)
    {
        $libs = array();

        $query = 'SELECT id, name, address, latitude, longitude, telephone, email,
            description, opening_time, closing_time, img FROM `Library`';
        if (!$stmt = $db->prepare($query)) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        }
        $stmt->execute();
        $templib = array();
        $stmt->bind_result($templib['id'], $templib['name'], $templib['address'], $templib['lat'], $templib['lon'],
            $templib['phone'], $templib['email'], $templib['description'], $templib['open'], $templib['close'], $templib['img']);

        while ($stmt->fetch()) {
            $lib = array();
            foreach ($templib as $key => $value) {
                $lib[$key] = htmlspecialchars($value);
            }
            array_push($libs, $lib);
        }

        $stmt->close();
        return $libs;
    }
?>
