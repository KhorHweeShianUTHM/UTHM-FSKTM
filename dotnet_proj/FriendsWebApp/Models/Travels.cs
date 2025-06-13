using System;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace FriendsWebApp.Models
{
    public class Travels
    {
        public int Id { get; set; }

        [Required] 
        public string TripName { get; set; }

        [Required] 
        public string Destination { get; set; }

        [Required]
        [DataType(DataType.Date)]
        public DateTime Date { get; set; }

        [Required] 
        public string Notes { get; set; }

        [Required] 
        public string CreatedBy { get; set; }
    }
}