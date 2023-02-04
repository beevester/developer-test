<?php

namespace Tests\Unit\Repository;

interface RepositoryTest
{
    public function test_sql_injection();

    public function test_database_connection_down();

    public function test_table_insert_passes();

    public function test_get_all_should_pass();

    public function test_get_by_id_should_return();

    public function test_delete_by_id_should_return();

}
