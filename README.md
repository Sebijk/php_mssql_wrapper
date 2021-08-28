# mssql Wrapper for PHP
PHP 7 removed the support of all legacy ``mssql_*`` functions. This files will restore the support using pdo_sqlsrv, sqlsrv or odbc driver wrapper.

## Usage

Include this file and legacy code that relies on ``mssql_*`` database calls will work in a modern environment.

* mssql.odbc_wrapper.php       - Will use odbc_ calls. Requires the php odbc module (shipped with PHP).
* mssql.pdo_sqlsrv_wrapper.php - Will use sqlsrv_ calls. Requires the pdo and pdo_sqlsrv module [Microsoft/msphpsql](https://github.com/Microsoft/msphpsql)
* mssql.sqlsrv_wrapper.php     - Will use sqlsrv_ calls. Requires the sqlsrv module [Microsoft/msphpsql](https://github.com/Microsoft/msphpsql)

You can choose one of the file, what you prefer.

## Why three different versions?

Because the main reason is the lack support of mssql_result function. Pull Request request to improve the wrappers are welcome.

## Original Version
* [bskrtich/mssqlwrapper](https://github.com/bskrtich/mssqlwrapper) (PDO sqlsrv Wrapper)
* [jonathanrowley/4721830](https://gist.github.com/JonathanRowley/4721830) (sqlsrv Wrapper)

## See Also

* [PHP MSSQL Documentation](https://php-legacy-docs.zend.com/manual/php5/en/book.mssql)
* [PDO_SQLSRV Drivers](http://www.microsoft.com/en-us/download/details.aspx?id=20098)