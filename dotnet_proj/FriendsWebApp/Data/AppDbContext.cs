using FriendsWebApp.Models;
using Microsoft.EntityFrameworkCore;

namespace FriendsWebApp.Data
{
    public class AppDbContext : DbContext
    {
        public AppDbContext(DbContextOptions<AppDbContext> options) : base(options) { }
        public DbSet<Diaries> Diaries { get; set; }
        public DbSet<Hobbies> Hobbies { get; set; }
        public DbSet<Recipes> Recipes { get; set; }
        public DbSet<Travels> Travels { get; set; }
    }
}