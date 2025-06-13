using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace FriendsWebApp.Migrations
{
    /// <inheritdoc />
    public partial class InitialCreateV4 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<string>(
                name: "CreatedBy",
                table: "Hobbies",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "CreatedBy",
                table: "Hobbies");
        }
    }
}
