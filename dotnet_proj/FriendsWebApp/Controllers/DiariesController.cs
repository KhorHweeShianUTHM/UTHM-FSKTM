using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using FriendsWebApp.Data;
using FriendsWebApp.Models;

namespace FriendsWebApp.Controllers
{
    public class DiariesController : Controller
    {
        private readonly AppDbContext _context;

        public DiariesController(AppDbContext context)
        {
            _context = context;
        }

        // GET: Diaries
        public async Task<IActionResult> Index()
        {
            return View(await _context.Diaries.ToListAsync());
        }

        // GET: Diaries/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var diaries = await _context.Diaries
                .FirstOrDefaultAsync(m => m.Id == id);
            if (diaries == null)
            {
                return NotFound();
            }

            return View(diaries);
        }

        // GET: Diaries/Create
        public IActionResult Create()
        {
            ViewBag.Members = new SelectList(new List<string> { "Khor", "Esya", "Tira", "Sofia" });
            ViewBag.MoodOptions = new SelectList(new List<string> { "Happy", "Excited", "Calm", "Tired", "Sad", "Angry" });
            return View();
        }

        // POST: Diaries/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Id,Title,Date,Mood,Content,CreatedBy")] Diaries diaries)
        {
            if (ModelState.IsValid)
            {
                _context.Add(diaries);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(diaries);
        }

        // GET: Diaries/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var diaries = await _context.Diaries.FindAsync(id);
            if (diaries == null)
            {
                return NotFound();
            }

            ViewBag.Members = new SelectList(new List<string> { "Khor", "Esya", "Tira", "Sofia" }, diaries.CreatedBy);
            ViewBag.MoodOptions = new SelectList(new List<string> { "Happy", "Excited", "Calm", "Tired", "Sad", "Angry" }, diaries.Mood);
            return View(diaries);
        }

        // POST: Diaries/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("Id,Title,Date,Mood,Content,CreatedBy")] Diaries diaries)
        {
            if (id != diaries.Id)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(diaries);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!DiariesExists(diaries.Id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            return View(diaries);
        }

        // GET: Diaries/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var diaries = await _context.Diaries
                .FirstOrDefaultAsync(m => m.Id == id);
            if (diaries == null)
            {
                return NotFound();
            }

            return View(diaries);
        }

        // POST: Diaries/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var diaries = await _context.Diaries.FindAsync(id);
            if (diaries != null)
            {
                _context.Diaries.Remove(diaries);
            }

            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool DiariesExists(int id)
        {
            return _context.Diaries.Any(e => e.Id == id);
        }
    }
}
