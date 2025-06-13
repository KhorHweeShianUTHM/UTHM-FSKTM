using System;
using System.ComponentModel.DataAnnotations;

namespace FriendsWebApp.Models
{
    public class Hobbies
    {
        public int Id { get; set; }

        [Required]
        [StringLength(50)]
        public string HobbyName { get; set; }

        [Required]
        public string Category { get; set; }  // e.g., Art, Sports, Music

        [Required]
        [DataType(DataType.Date)]
        public DateTime StartedOn { get; set; }

        [Required]
        [DataType(DataType.MultilineText)]
        public string Notes { get; set; }

        [Required]
        public string CreatedBy { get; set; }
    }
}