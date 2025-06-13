using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace FriendsWebApp.Migrations
{
    /// <inheritdoc />
    public partial class InitialCreateV5 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "Goals");

            migrationBuilder.DropColumn(
                name: "Budget",
                table: "Travels");

            migrationBuilder.DropColumn(
                name: "Companion",
                table: "Travels");

            migrationBuilder.DropColumn(
                name: "EndDate",
                table: "Travels");

            migrationBuilder.RenameColumn(
                name: "StartDate",
                table: "Travels",
                newName: "Date");

            migrationBuilder.AlterColumn<string>(
                name: "Destination",
                table: "Travels",
                type: "nvarchar(max)",
                nullable: false,
                oldClrType: typeof(string),
                oldType: "nvarchar(100)",
                oldMaxLength: 100);

            migrationBuilder.AddColumn<string>(
                name: "ImagePath",
                table: "Travels",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");

            migrationBuilder.AddColumn<string>(
                name: "Participants",
                table: "Travels",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");

            migrationBuilder.AddColumn<string>(
                name: "TripName",
                table: "Travels",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "ImagePath",
                table: "Travels");

            migrationBuilder.DropColumn(
                name: "Participants",
                table: "Travels");

            migrationBuilder.DropColumn(
                name: "TripName",
                table: "Travels");

            migrationBuilder.RenameColumn(
                name: "Date",
                table: "Travels",
                newName: "StartDate");

            migrationBuilder.AlterColumn<string>(
                name: "Destination",
                table: "Travels",
                type: "nvarchar(100)",
                maxLength: 100,
                nullable: false,
                oldClrType: typeof(string),
                oldType: "nvarchar(max)");

            migrationBuilder.AddColumn<decimal>(
                name: "Budget",
                table: "Travels",
                type: "decimal(18,2)",
                precision: 18,
                scale: 2,
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AddColumn<string>(
                name: "Companion",
                table: "Travels",
                type: "nvarchar(50)",
                maxLength: 50,
                nullable: false,
                defaultValue: "");

            migrationBuilder.AddColumn<DateTime>(
                name: "EndDate",
                table: "Travels",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(1, 1, 1, 0, 0, 0, 0, DateTimeKind.Unspecified));

            migrationBuilder.CreateTable(
                name: "Goals",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Category = table.Column<string>(type: "nvarchar(50)", maxLength: 50, nullable: false),
                    GoalTitle = table.Column<string>(type: "nvarchar(100)", maxLength: 100, nullable: false),
                    IsAchieved = table.Column<bool>(type: "bit", nullable: false),
                    Notes = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    TargetDate = table.Column<DateTime>(type: "datetime2", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Goals", x => x.Id);
                });
        }
    }
}
