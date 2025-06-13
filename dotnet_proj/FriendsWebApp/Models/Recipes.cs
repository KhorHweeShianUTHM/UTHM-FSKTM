using System;
using System.ComponentModel.DataAnnotations;

namespace FriendsWebApp.Models
{
    public class Recipes
    {
        public int Id { get; set; }

        [Required]
        [StringLength(100)]
        public string RecipeName { get; set; }

        [DataType(DataType.MultilineText)]
        public string Ingredients { get; set; }

        [DataType(DataType.MultilineText)]
        public string Steps { get; set; }

        [StringLength(30)]
        public string Category { get; set; }  // e.g., Dessert, Main Course, Drink

        [DataType(DataType.Date)]
        public DateTime CreatedOn { get; set; }
    }
}