using System;
using System.ComponentModel.DataAnnotations;

namespace FriendsWebApp.Models
{
    public class Diaries
    {
        public int Id { get; set; }

        [Required]
        [StringLength(100)]
        public string Title { get; set; }

        [Required]
        [DataType(DataType.Date)]
        public DateTime Date { get; set; }

        [Required]
        public string Mood { get; set; } // Example: Happy, Sad, Excited

        [Required]
        [DataType(DataType.MultilineText)]
        public string Content { get; set; }

        [Required]
        public string CreatedBy { get; set; }
    }
}
