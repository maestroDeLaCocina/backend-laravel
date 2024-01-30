<?php

use App\Models\State;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemaTable extends Migration
{
    private const statuses = [
        'createFlag' => true,
        'downFlag' => true,
    ];

    private const tables = [
        'Catalog' => [
            'States',
        ],
        'Table' => [
            'Users',
            'Todos',
            'Tasks',
            'Steps',
        ],
        'Pivot' => [
            'TaskUser',
        ]
    ];

    private static function pascalToSnake(string $tableName): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $tableName));
//        return str_replace('_', '', ucwords('role_user', '_'));
    }

    public function up(): void
    {
        foreach (self::tables as $type => $schemas) {
            foreach ($schemas as $tableName) {
                $functionName = ('__' . (self::statuses['createFlag'] ? 'create' : 'update') . $tableName . $type);
                if (method_exists($this, $functionName)) self::$functionName(self::pascalToSnake($tableName));
            }
        }
    }

    public function down(): void
    {
        if (!self::statuses['downFlag']) return;
        $tablesReverse = array_reverse(self::tables);
        foreach ($tablesReverse as $schemas) {
            $schemasReverse = array_reverse($schemas);
            foreach ($schemasReverse as $table) {
                Schema::dropIfExists($table);
            }
        }
    }

    private static function __createStatesCatalog(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    private static function __createUsersTable(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('second_last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    private static function __createTodosTable(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('due_date');
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    private static function __createTasksTable(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('due_date');
            $table->foreignIdFor(Todo::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->timestamps();
        });
    }

    private static function __createStepsTable(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamp('due_date');
            $table->foreignIdFor(Task::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->timestamps();
        });
    }

    private static function __createTaskUserPivot(string $tableName): void
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->timestamp('due_date');
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Task::class)->constrained();
            $table->foreignIdFor(State::class)->constrained();
            $table->timestamps();
        });
    }
}
