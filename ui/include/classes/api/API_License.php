<?php declare(strict_types=1);
class API_License {
    
    public static function get(array $options = []): array {
        $sql = 'SELECT lsid, ls_text, ls_year,status, created_at FROM tinasoft_ls';

        // Giới hạn
        if (isset($options['limit'])) {
            $limit = (int)$options['limit'];
            $sql .= ' LIMIT '.$limit;
        }

        $res = DBselect($sql);

        return DBfetchArrayAssoc($res, 'lsid');
    }

    public static function create(array $data): bool {
        return DB::insert('tinasoft_ls', [
            'ls_text'    => $data['ls_text'],
            'ls_year'    => $data['ls_year'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public static function update(int $lsid, array $data): bool {
        return DB::update('tinasoft_ls', [
            'ls_text' => $data['ls_text'],
            'ls_year' => $data['ls_year']
        ], ['lsid' => $lsid]);
    }

    public static function delete(int $lsid): bool {
        return DB::delete('tinasoft_ls', ['lsid' => $lsid]);
    }
}
